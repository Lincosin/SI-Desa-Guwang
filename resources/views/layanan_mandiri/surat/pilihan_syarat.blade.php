{{-- KUSTOM unggah syarat: warga bisa memilih dokumen yang sudah ada atau langsung mengunggah file --}}
@php
    $tertunda = $unggah_tertunda[$syarat_id] ?? null;
@endphp
<div class="form-group form-horizontal syarat-pilihan" data-tertunda="{{ $tertunda ? 1 : 0 }}">
    <select class="form-control input-sm syarat {{ $tertunda ? '' : 'required' }}" name="syarat[{{ $syarat_id }}]" onchange="cek_perhatian($(this));">
        <option value=""> -- Pilih dokumen yang melengkapi syarat -- </option>
        @foreach ($dokumen as $data)
            @if ($data['id_syarat'] == $syarat_id)
                <option @selected($data['id'] == $syarat_permohonan[$syarat_id]) value="{{ $data['id'] }}">{{ $data['nama'] }}</option>
            @endif
        @endforeach
        @if ($cek_anjungan)
            <option @selected('-1' == $syarat_permohonan[$syarat_id]) value="-1">Bawa bukti fisik ke Kantor Desa</option>
        @endif
    </select>
    <i class="fa fa-exclamation-triangle text-red perhatian" style="display: none; padding-left: 10px; font-weight: bold;">&nbsp;Perhatian!</i>
    <div class="syarat-unggah" style="margin-top: 6px;">
        <label class="btn btn-default btn-sm" style="margin: 0;" title="Unggah file JPG, PNG atau PDF">
            <i class="fa fa-upload"></i> atau Unggah File
            <input type="file" class="hidden syarat-file" name="syarat_file[{{ $syarat_id }}]" accept=".jpg,.jpeg,.png,.pdf" />
        </label>
        <span class="syarat-file-nama small" style="padding-left: 6px;">
            @if ($tertunda)
                <i class="fa fa-check text-green"></i> File sudah diunggah
            @endif
        </span>
    </div>
</div>
