{{-- Floating Chat Button --}}
<div id="floating-chat-btn" style="position:fixed;bottom:80px;right:24px;z-index:9999;">
    <button class="btn btn-primary rounded-circle shadow" style="width:56px;height:56px;" onclick="toggleChatBox()">
        <i class="fas fa-comments fa-lg"></i>
        <span id="chat-notif-badge" style="display:none;position:absolute;top:8px;right:8px;background:red;color:white;border-radius:50%;width:18px;height:18px;font-size:12px;line-height:18px;text-align:center;">!</span>
    </button>
</div>
{{-- Floating Chat Box --}}
<div id="chat-box" style="display:none;position:fixed;bottom:150px;right:24px;width:340px;z-index:9999;background:#fff;border-radius:1rem;box-shadow:0 4px 24px rgba(13,110,253,0.13);overflow:hidden;">
    <div class="p-3 border-bottom bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-comments me-2"></i>Chat</span>
        <button class="btn btn-sm btn-light" onclick="toggleChatBox()">&times;</button>
    </div>
    <div class="p-2 border-bottom" style="background:#f8f9fa;">
        <div style="position:relative;">
            <input type="text" id="chat-user-search" class="form-control form-control-sm" placeholder="Cari nama user...">
            <div id="chat-user-suggestions" class="list-group position-absolute w-100" style="z-index:10000;max-height:180px;overflow-y:auto;display:none;"></div>
        </div>
    </div>
    <div id="chat-messages" style="height:220px;overflow-y:auto;padding:10px;background:#f9f9f9;"></div>
    <form id="chat-form" class="d-flex border-top" style="background:#f8f9f9;">
        <input type="text" id="chat-input" class="form-control border-0" placeholder="Ketik pesan..." autocomplete="off">
        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>

<!-- Audio notifikasi pesan baru -->
<audio id="chat-notif-sound" src="/sounds/chat.mp3" preload="auto"></audio>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentChatId = null;
let polling = null;
let notifPolling = null;
let lastNotifCount = 0;
function toggleChatBox() {
    const box = document.getElementById('chat-box');
    box.style.display = (box.style.display === 'none' || !box.style.display) ? 'block' : 'none';
    // Jika chat dibuka, hilangkan badge notifikasi
    if (box.style.display === 'block') {
        document.getElementById('chat-notif-badge').style.display = 'none';
        lastNotifCount = 0;
    }
}
// Autocomplete user search
function searchUserSuggestions(keyword) {
    if (!keyword) {
        $('#chat-user-suggestions').hide();
        return;
    }
    $.get('/chat/users', {search: keyword}, function(res) {
        let html = '';
        if (res.users.length === 0) {
            html = '<div class="list-group-item disabled">Tidak ada user ditemukan</div>';
        } else {
            res.users.forEach(function(user) {
                html += `<button type="button" class="list-group-item list-group-item-action" data-id="${user.id}">${user.name}</button>`;
            });
        }
        $('#chat-user-suggestions').html(html).show();
    });
}
$(document).ready(function() {
    // Polling notifikasi pesan baru
    notifPolling = setInterval(checkNewMessages, 5000);
    // Event pencarian user autocomplete
    $('#chat-user-search').on('input', function() {
        const keyword = $(this).val();
        searchUserSuggestions(keyword);
    });
    // Pilih user dari suggestion
    $('#chat-user-suggestions').on('click', 'button', function() {
        const userId = $(this).data('id');
        const userName = $(this).text();
        $('#chat-user-search').val(userName);
        $('#chat-user-suggestions').hide();
        // Mulai chat langsung
        $.post("{{ route('chat.start') }}", {_token: '{{ csrf_token() }}', user_id: userId}, function(res) {
            if (res.chat_id) {
                currentChatId = res.chat_id;
                loadMessages();
                if (polling) clearInterval(polling);
                polling = setInterval(loadMessages, 3000);
            }
        });
    });
    // Hide suggestion saat klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#chat-user-search, #chat-user-suggestions').length) {
            $('#chat-user-suggestions').hide();
        }
    });
});
function loadMessages() {
    if (!currentChatId) return;
    $.get("/chat/messages/" + currentChatId, function(res) {
        let html = '';
        res.messages.forEach(function(msg) {
            html += `<div class=\"mb-2 ${msg.sender_id == {{ auth()->id() }} ? 'text-end' : 'text-start'}\">\n                <span class=\"badge bg-${msg.sender_id == {{ auth()->id() }} ? 'primary' : 'secondary'}\">${msg.sender.name}</span><br>\n                <span class=\"p-2 d-inline-block\" style=\"background:#e9ecef;border-radius:1rem;max-width:80%;\">${msg.message}</span>\n            </div>`;
        });
        $('#chat-messages').html(html);
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        // Tandai pesan sudah dibaca
        $.post('/chat/read/' + currentChatId, {_token: '{{ csrf_token() }}'});
    });
}
$('#chat-form').on('submit', function(e) {
    e.preventDefault();
    const msg = $('#chat-input').val();
    if (!msg || !currentChatId) return;
    $.post("{{ route('chat.send') }}", {_token: '{{ csrf_token() }}', chat_id: currentChatId, message: msg}, function() {
        $('#chat-input').val('');
        loadMessages();
    });
});
// Polling notifikasi pesan baru
function checkNewMessages() {
    $.get('/chat/check-new', function(res) {
        if (res.count > 0) {
            document.getElementById('chat-notif-badge').style.display = 'inline-block';
            // Mainkan suara hanya jika sebelumnya tidak ada notif
            if (lastNotifCount === 0) {
                document.getElementById('chat-notif-sound').play();
            }
            lastNotifCount = res.count;
        } else {
            document.getElementById('chat-notif-badge').style.display = 'none';
            lastNotifCount = 0;
        }
    });
}
</script>

<style>
  @media (max-width: 600px) {
    #floating-chat-btn {
      bottom: 110px !important;
      right: 16px !important;
    }
    #chat-box {
      bottom: 180px !important;
      right: 8px !important;
      width: 98vw !important;
      max-width: 360px;
    }
  }
</style>