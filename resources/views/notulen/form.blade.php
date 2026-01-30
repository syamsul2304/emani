@csrf

<div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $notulen->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="agenda" class="form-label">Agenda</label>
    <input type="text" name="agenda" class="form-control" value="{{ old('agenda', $notulen->agenda ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $notulen->tanggal ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="waktu" class="form-label">Waktu</label>
    <input type="time" name="waktu" class="form-control" value="{{ old('waktu', $notulen->waktu ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tempat" class="form-label">Tempat</label>
    <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $notulen->tempat ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="peserta" class="form-label">Peserta</label>
    <textarea name="peserta" class="form-control" required>{{ old('peserta', $notulen->peserta ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="pembahasan" class="form-label">Pembahasan</label>
    <textarea name="pembahasan" class="form-control" required>{{ old('pembahasan', $notulen->pembahasan ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="keputusan" class="form-label">Keputusan</label>
    <textarea name="keputusan" class="form-control" required>{{ old('keputusan', $notulen->keputusan ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="notulis" class="form-label">Notulis</label>
    <input type="text" name="notulis" class="form-control" value="{{ old('notulis', $notulen->notulis ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="lampiran" class="form-label">Lampiran</label>
    <input type="file" name="lampiran" class="form-control">

    @if (!empty($notulen->lampiran))
        <small class="text-muted d-block mt-1">Lampiran saat ini: 
            <a href="{{ asset('storage/lampiran/' . $notulen->lampiran) }}" target="_blank">Lihat Lampiran</a>
        </small>
    @endif
</div>
