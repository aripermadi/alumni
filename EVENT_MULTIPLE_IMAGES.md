# Fitur Multiple Images untuk Event

## Overview
Fitur ini memungkinkan setiap event untuk memiliki lebih dari satu gambar dengan caption yang dapat dikelola secara terpisah.

## Struktur Database

### Tabel `event_images`
- `id` - Primary key
- `event_id` - Foreign key ke tabel events
- `image_path` - Path file gambar
- `caption` - Caption/deskripsi gambar (opsional)
- `order` - Urutan tampilan gambar
- `created_at` dan `updated_at` - Timestamp

## Fitur yang Ditambahkan

### 1. Form Create Event
- Input multiple images dengan preview
- Caption untuk setiap gambar
- Tombol untuk menambah/hapus input gambar
- Backward compatibility dengan single image

### 2. Form Edit Event
- Menampilkan gambar existing dengan caption
- Kemampuan untuk menghapus gambar individual
- Menambah gambar baru
- Preview gambar sebelum upload

### 3. View Show Event
- Galeri gambar dengan modal popup
- Caption untuk setiap gambar
- Responsive grid layout

### 4. View Public Show Event
- Galeri gambar yang sama dengan show
- Modal popup untuk melihat gambar detail

### 5. Management Event
- Menampilkan gambar utama di list event
- Backward compatibility dengan gambar lama

## Cara Penggunaan

### Menambah Event dengan Multiple Images
1. Buka halaman "Tambah Event"
2. Isi informasi event (judul, deskripsi, tanggal, lokasi)
3. Di bagian "Gambar Event (Multiple)":
   - Upload gambar pertama
   - Tambahkan caption (opsional)
   - Klik "+ Tambah Gambar" untuk menambah gambar lain
   - Ulangi sampai semua gambar ditambahkan
4. Klik "Simpan"

### Edit Event
1. Buka halaman edit event
2. Lihat gambar existing di bagian "Gambar Event Saat Ini"
3. Klik "Hapus Gambar" untuk menghapus gambar individual
4. Di bagian "Tambah Gambar Baru" untuk menambah gambar baru
5. Klik "Update"

### Melihat Galeri Event
1. Buka detail event
2. Scroll ke bagian "Galeri Event"
3. Klik gambar untuk melihat dalam modal popup
4. Caption akan ditampilkan di bawah gambar

## API Endpoints

### DELETE `/events/{event}/images/{image}`
Menghapus gambar event tertentu
- Method: DELETE
- Authentication: Required
- Response: JSON dengan status success/error

## Model Relationships

### Event Model
```php
public function images()
{
    return $this->hasMany(EventImage::class)->orderBy('order');
}

public function getMainImageAttribute()
{
    return $this->image ?? $this->images->first()?->image_path;
}
```

### EventImage Model
```php
public function event()
{
    return $this->belongsTo(Event::class);
}
```

## Backward Compatibility
- Event lama dengan single image tetap dapat ditampilkan
- Field `image` di tabel events tetap digunakan sebagai gambar utama
- Jika tidak ada gambar utama, akan menggunakan gambar pertama dari galeri

## File Storage
- Gambar disimpan di `storage/app/public/events/`
- Gambar dioptimasi jika ukuran > 2MB
- Format yang didukung: JPG, PNG, GIF, dll

## JavaScript Features
- Preview gambar sebelum upload
- Dynamic form untuk menambah/hapus input gambar
- Modal popup untuk melihat gambar detail
- AJAX untuk menghapus gambar tanpa reload halaman

## CSS Styling
- Responsive grid layout
- Hover effects pada gambar
- Modal styling dengan Bootstrap
- Card layout untuk galeri

## Keamanan
- Validasi file upload (tipe dan ukuran)
- CSRF protection untuk AJAX requests
- Authorization check untuk menghapus gambar
- Sanitasi input caption 