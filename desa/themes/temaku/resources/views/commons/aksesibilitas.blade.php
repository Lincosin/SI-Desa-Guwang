{{--
    Alat Aksesibilitas (tombol mengambang di tepi kanan layar + bisa dibuka dari tombol "Aksesibilitas" di bilah atas).
    Berkas ini MANDIRI: CSS, markup, dan JavaScript ada di sini, jadi tidak bergantung pada
    assets/css/aksesibilitas.css atau assets/js/aksesibilitas.js (berkas itu boleh dihapus).
    Perilaku sama dengan alat aksesibilitas di halaman Layanan Mandiri.
--}}
@verbatim
<style>
/* Alat Aksesibilitas Temaku. Awalan kelas a11y- agar tidak bentrok dengan Tailwind/Bootstrap tema. */

/* ---- Efek yang dipasang ke <html> oleh aksesibilitas.js ---- */
html.a11y-gray { filter: grayscale(1); }
html.a11y-neg { filter: invert(1) hue-rotate(180deg); }
html.a11y-gray.a11y-neg { filter: grayscale(1) invert(1) hue-rotate(180deg); }
/* Gambar dan video dibalik lagi supaya foto tidak tampak seperti negatif film */
html.a11y-neg img,
html.a11y-neg video,
html.a11y-neg picture,
html.a11y-neg .leaflet-container,
html.a11y-neg iframe { filter: invert(1) hue-rotate(180deg); }
html.a11y-underline a { text-decoration: underline !important; text-underline-offset: 3px; }

/* ---- Widget ---- */
.a11y-widget {
    --a11y-accent: var(--primary-base-color, #006496);
    position: fixed;
    top: 50%;
    right: 0;
    z-index: 9990;
    transform: translateY(-50%);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
    font-size: 14px;
    line-height: 1.4;
}

.a11y-fab {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 52px;
    padding: 0;
    border: 0;
    border-radius: 14px 0 0 14px;
    background: var(--a11y-accent);
    color: #fff;
    cursor: pointer;
    box-shadow: -2px 2px 10px rgba(0, 0, 0, .25);
    transition: width .15s ease, background-color .15s ease;
}
.a11y-fab:hover,
.a11y-fab[aria-expanded="true"] { width: 52px; }
.a11y-fab:focus-visible,
.a11y-item:focus-visible,
.a11y-close:focus-visible { outline: 3px solid #f59e0b; outline-offset: 2px; }

.a11y-panel {
    position: absolute;
    top: 50%;
    right: 56px;
    width: 280px;
    max-height: 80vh;
    overflow-y: auto;
    transform: translateY(-50%);
    border-radius: 14px;
    background: #fff;
    color: #1f2937;
    box-shadow: 0 12px 32px rgba(0, 0, 0, .28);
}
.a11y-panel[hidden] { display: none; }

.a11y-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px 12px 16px;
    border-radius: 14px 14px 0 0;
    background: var(--a11y-accent);
    color: #fff;
    font-size: 15px;
}
.a11y-close {
    width: 30px;
    height: 30px;
    padding: 0 !important;
    margin: 0 !important;
    border: 0;
    border-radius: 8px;
    background: rgba(255, 255, 255, .18);
    color: #fff;
    cursor: pointer;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 20px;
    line-height: 0 !important; /* Wajib: line-height 0 mematikan ruang vertikal ekstra font */
    box-sizing: border-box;
}

.a11y-close svg {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 0 !important;
    margin-top: -10px !important;
    padding: 0 !important;
}

.a11y-close:hover { 
    background: rgba(255, 255, 255, .32); 
}

.a11y-list { margin: 0; padding: 8px; list-style: none; }
.a11y-list li + li { margin-top: 4px; }

.a11y-item {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 9px 10px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    background: #fff;
    color: inherit;
    font: inherit;
    text-align: left;
    cursor: pointer;
    transition: background-color .15s ease, border-color .15s ease;
}
.a11y-item:hover { background: #f3f4f6; border-color: #cbd5e1; }
.a11y-ico {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 34px;
    height: 34px;
    border-radius: 9px;
    background: #eef2f7;
    color: var(--a11y-accent);
    font-weight: 700;
    font-size: 14px;
}
.a11y-txt { flex: 1 1 auto; font-weight: 600; }
.a11y-val { font-size: 12px; font-weight: 700; color: var(--a11y-accent); }

/* Saklar */
.a11y-sw {
    position: relative;
    flex: 0 0 36px;
    height: 20px;
    border-radius: 999px;
    background: #cbd5e1;
    transition: background-color .15s ease;
}
.a11y-sw::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .3);
    transition: transform .15s ease;
}
.a11y-item[aria-pressed="true"] { border-color: var(--a11y-accent); background: #f0f7fb; }
.a11y-item[aria-pressed="true"] .a11y-sw { background: var(--a11y-accent); }
.a11y-item[aria-pressed="true"] .a11y-sw::after { transform: translateX(16px); }
.a11y-item[aria-pressed="true"] .a11y-ico { background: var(--a11y-accent); color: #fff; }
.a11y-item:disabled { opacity: .55; cursor: not-allowed; }
.a11y-reset .a11y-ico { background: #fee2e2; color: #b91c1c; }

.a11y-help { margin: 4px 4px 2px; font-size: 12px; color: #4b5563; }
.a11y-help[hidden] { display: none; }

.a11y-sr {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

/* Mode gelap tema */
html.dark .a11y-panel { background: #141d30; color: #e6ebf5; }
html.dark .a11y-item { background: #141d30; border-color: #2a3650; }
html.dark .a11y-item:hover { background: #1b2640; border-color: #3a4a6b; }
html.dark .a11y-ico { background: #1b2640; color: #7cc4ec; }
html.dark .a11y-val { color: #7cc4ec; }
html.dark .a11y-sw { background: #3a4a6b; }
html.dark .a11y-item[aria-pressed="true"] { background: #16233d; }
html.dark .a11y-item[aria-pressed="true"] .a11y-ico { background: var(--a11y-accent); color: #fff; }
html.dark .a11y-reset .a11y-ico { background: #3b1d1d; color: #fca5a5; }
html.dark .a11y-help { color: #9aa3b2; }

@media (max-width: 480px) {
    .a11y-panel { width: min(280px, calc(100vw - 70px)); }
}
@media (prefers-reduced-motion: reduce) {
    .a11y-fab, .a11y-item, .a11y-sw, .a11y-sw::after { transition: none; }
}
@media print {
    .a11y-widget { display: none !important; }
}
</style>
@endverbatim

<div id="a11y-widget" class="a11y-widget">
    <button type="button" id="a11y-fab" class="a11y-fab" aria-expanded="false" aria-controls="a11y-panel"
        aria-label="Buka Alat Aksesibilitas" title="Alat Aksesibilitas">
        <svg width="26" height="26" fill="currentColor" aria-hidden="true" focusable="false">
            <path d="M12 2a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm8 6.5v1.8c0 .5-.4.9-.9.9-2.2.1-4.1.4-5.1.7V22h-2v-5h-2v5H8V12c-1-.3-2.9-.6-5.1-.7-.5 0-.9-.4-.9-.9V8.5c0-.6.5-1 1.1-.9 2.7.3 5.2.5 8.9.5s6.2-.2 8.9-.5c.6-.1 1.1.3 1.1.9z"/>
        </svg>
    </button>

    <div id="a11y-panel" class="a11y-panel" role="dialog" aria-label="Alat Aksesibilitas" hidden>
        <div class="a11y-head">
            <strong>Alat Aksesibilitas</strong>
            <button type="button" class="a11y-close" data-a11y="tutup" aria-label="Tutup Alat Aksesibilitas">x</button>
        </div>

        <ul class="a11y-list">
            <li>
                <button type="button" class="a11y-item" data-a11y="plus">
                    <span class="a11y-ico" aria-hidden="true">A+</span>
                    <span class="a11y-txt">Perbesar Teks</span>
                    <span class="a11y-val" data-a11y-ukuran>100%</span>
                </button>
            </li>
            <li>
                <button type="button" class="a11y-item" data-a11y="minus">
                    <span class="a11y-ico" aria-hidden="true">A&minus;</span>
                    <span class="a11y-txt">Perkecil Teks</span>
                </button>
            </li>
            <li>
                <button type="button" class="a11y-item" data-a11y="gray" aria-pressed="false">
                    <span class="a11y-ico" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor" stroke="none"/></svg>
                    </span>
                    <span class="a11y-txt">Skala Abu-abu</span>
                    <span class="a11y-sw" aria-hidden="true"></span>
                </button>
            </li>
            <li>
                <button type="button" class="a11y-item" data-a11y="neg" aria-pressed="false">
                    <span class="a11y-ico" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 3h18v18z" fill="currentColor" stroke="none"/></svg>
                    </span>
                    <span class="a11y-txt">Kontras Negatif</span>
                    <span class="a11y-sw" aria-hidden="true"></span>
                </button>
            </li>
            <li>
                <button type="button" class="a11y-item" data-a11y="underline" aria-pressed="false">
                    <span class="a11y-ico" aria-hidden="true"><span style="text-decoration:underline">U</span></span>
                    <span class="a11y-txt">Garis Bawah Tautan</span>
                    <span class="a11y-sw" aria-hidden="true"></span>
                </button>
            </li>
            <li>
                <button type="button" class="a11y-item" data-a11y="tts" aria-pressed="false">
                    <span class="a11y-ico" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M3 9v6h4l5 4V5L7 9H3zm13.5 3a4.5 4.5 0 0 0-2.5-4.03v8.06A4.5 4.5 0 0 0 16.5 12zM14 3.23v2.06a7 7 0 0 1 0 13.42v2.06a9 9 0 0 0 0-17.54z"/></svg>
                    </span>
                    <span class="a11y-txt">Teks ke Suara</span>
                    <span class="a11y-sw" aria-hidden="true"></span>
                </button>
                <p class="a11y-help" data-a11y-tts-bantuan hidden>Blok teks, atau klik paragraf atau judul, untuk mendengarkan.</p>
            </li>
            <li>
                <button type="button" class="a11y-item a11y-reset" data-a11y="reset">
                    <span class="a11y-ico" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 5V2L7 6l5 4V7a5 5 0 1 1-5 5H5a7 7 0 1 0 7-7z"/></svg>
                    </span>
                    <span class="a11y-txt">Atur Ulang</span>
                </button>
            </li>
        </ul>
    </div>

    {{-- Pengumuman status untuk pembaca layar --}}
    <div id="a11y-live" class="a11y-sr" aria-live="polite" role="status"></div>
</div>

@verbatim
<script>
/*
 * Alat Aksesibilitas Temaku (tanpa dependensi).
 * Fitur: perbesar/perkecil teks, skala abu-abu, kontras negatif, garis bawah tautan, teks ke suara, atur ulang.
 * Pilihan disimpan di localStorage "temaku-a11y". Pemasangan awal (sebelum halaman tampil) dilakukan skrip
 * kecil di <head> template.blade.php; berkas ini mengurus tombol, panel, dan suara.
 */
(function () {
    'use strict';
    if (window.__temakuA11y) { return; }       // sudah dipasang (mis. oleh berkas lain): jangan pasang dua kali
    window.__temakuA11y = true;

    var KEY = 'temaku-a11y';
    var MIN = -2, MAX = 5, LANGKAH = 10;           // ukuran teks: 80% sampai 150%, per 10%
    var root = document.documentElement;
    var DEFAULT = { size: 0, gray: false, neg: false, underline: false, tts: false };

    function muat() {
        var s = {};
        try { s = JSON.parse(window.localStorage.getItem(KEY) || '{}') || {}; } catch (e) { s = {}; }
        var hasil = {
            size: Math.max(MIN, Math.min(MAX, parseInt(s.size, 10) || 0)),
            gray: s.gray === true, neg: s.neg === true, underline: s.underline === true, tts: s.tts === true
        };
        return hasil;
    }
    function simpan() {
        try {
            var kosong = JSON.stringify(state) === JSON.stringify(DEFAULT);
            if (kosong) { window.localStorage.removeItem(KEY); } else { window.localStorage.setItem(KEY, JSON.stringify(state)); }
        } catch (e) { /* localStorage diblokir: pilihan berlaku untuk halaman ini saja */ }
    }

    var state = muat();

    /* ---------- Suara (Web Speech API) ---------- */
    var synth = window.speechSynthesis;
    var bisaBicara = !!synth && 'SpeechSynthesisUtterance' in window;
    var suaraId = null;

    function pilihSuara() {
        if (!bisaBicara) { return; }
        var daftar = synth.getVoices() || [];
        suaraId = daftar.filter(function (v) { return /^id([-_]|$)/i.test(v.lang); })[0] || null;
    }
    if (bisaBicara) {
        pilihSuara();
        if (synth.addEventListener) { synth.addEventListener('voiceschanged', pilihSuara); }
    }
    function bicara(teks) {
        if (!bisaBicara) { return; }
        teks = String(teks || '').replace(/\s+/g, ' ').trim();
        if (!teks) { return; }
        try {
            synth.cancel();
            var u = new window.SpeechSynthesisUtterance(teks.slice(0, 3000));
            u.lang = 'id-ID';
            if (suaraId) { u.voice = suaraId; }
            synth.speak(u);
        } catch (e) { /* mesin suara bermasalah: abaikan, fitur lain tetap jalan */ }
    }
    function diam() { try { if (bisaBicara) { synth.cancel(); } } catch (e) { /* abaikan */ } }

    /* ---------- Menerapkan pilihan ---------- */
    var fab, panel, live, pemicu = null;

    function umumkan(pesan) { if (live) { live.textContent = ''; setTimeout(function () { live.textContent = pesan; }, 30); } }

    function terapkan() {
        if (state.size === 0) { root.style.removeProperty('font-size'); } else { root.style.fontSize = (100 + state.size * LANGKAH) + '%'; }
        root.classList.toggle('a11y-gray', state.gray);
        root.classList.toggle('a11y-neg', state.neg);
        root.classList.toggle('a11y-underline', state.underline);

        if (!panel) { return; }
        var nilai = panel.querySelector('[data-a11y-ukuran]');
        if (nilai) { nilai.textContent = (100 + state.size * LANGKAH) + '%'; }
        panel.querySelector('[data-a11y="plus"]').disabled = state.size >= MAX;
        panel.querySelector('[data-a11y="minus"]').disabled = state.size <= MIN;
        ['gray', 'neg', 'underline', 'tts'].forEach(function (k) {
            var b = panel.querySelector('[data-a11y="' + k + '"]');
            if (b) { b.setAttribute('aria-pressed', state[k] ? 'true' : 'false'); }
        });
        var bantuan = panel.querySelector('[data-a11y-tts-bantuan]');
        if (bantuan) { bantuan.hidden = !state.tts; }
    }

    var AKSI = {
        plus: function () { if (state.size < MAX) { state.size++; } umumkan('Ukuran teks ' + (100 + state.size * LANGKAH) + ' persen'); },
        minus: function () { if (state.size > MIN) { state.size--; } umumkan('Ukuran teks ' + (100 + state.size * LANGKAH) + ' persen'); },
        gray: function () { state.gray = !state.gray; umumkan('Skala abu-abu ' + (state.gray ? 'aktif' : 'nonaktif')); },
        neg: function () { state.neg = !state.neg; umumkan('Kontras negatif ' + (state.neg ? 'aktif' : 'nonaktif')); },
        underline: function () { state.underline = !state.underline; umumkan('Garis bawah tautan ' + (state.underline ? 'aktif' : 'nonaktif')); },
        tts: function () {
            if (!bisaBicara) { umumkan('Browser ini tidak mendukung teks ke suara'); return; }
            state.tts = !state.tts;
            if (state.tts) { bicara('Teks ke suara aktif'); } else { diam(); }
        },
        reset: function () { state = { size: 0, gray: false, neg: false, underline: false, tts: false }; diam(); umumkan('Pengaturan aksesibilitas diatur ulang'); },
        tutup: function () { tutupPanel(true); }
    };

    /* ---------- Panel ---------- */
    function tandaiPemicu(buka) {
        document.querySelectorAll('[data-a11y-buka]').forEach(function (b) { b.setAttribute('aria-expanded', buka ? 'true' : 'false'); });
    }
    function bukaPanel(dari) {
        pemicu = dari || fab;
        panel.hidden = false;
        fab.setAttribute('aria-expanded', 'true');
        fab.setAttribute('aria-label', 'Tutup Alat Aksesibilitas');
        tandaiPemicu(true);
        var pertama = panel.querySelector('.a11y-item:not(:disabled)');
        if (pertama) { pertama.focus(); }
    }
    function tutupPanel(kembaliFokus) {
        if (panel.hidden) { return; }
        panel.hidden = true;
        fab.setAttribute('aria-expanded', 'false');
        fab.setAttribute('aria-label', 'Buka Alat Aksesibilitas');
        tandaiPemicu(false);
        if (kembaliFokus) { (pemicu || fab).focus(); }
    }

    function siap() {
        fab = document.getElementById('a11y-fab');
        panel = document.getElementById('a11y-panel');
        live = document.getElementById('a11y-live');
        if (!fab || !panel) { return; }

        if (!bisaBicara) {
            var t = panel.querySelector('[data-a11y="tts"]');
            if (t) { t.disabled = true; t.title = 'Browser ini tidak mendukung teks ke suara'; }
            state.tts = false;
        }

        fab.addEventListener('click', function () { if (panel.hidden) { bukaPanel(fab); } else { tutupPanel(false); } });
        document.addEventListener('click', function (e) {
            var t = e.target.closest('[data-a11y-buka]');
            if (!t) { return; }
            e.preventDefault();
            if (panel.hidden) { bukaPanel(t); } else { tutupPanel(false); }
        });

        panel.addEventListener('click', function (e) {
            var b = e.target.closest('[data-a11y]');
            if (!b || b.disabled) { return; }
            var aksi = AKSI[b.getAttribute('data-a11y')];
            if (aksi) { aksi(); terapkan(); simpan(); }
        });

        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { tutupPanel(true); } });
        document.addEventListener('click', function (e) {
            if (!panel.hidden && !e.target.closest('#a11y-widget') && !e.target.closest('[data-a11y-buka]')) { tutupPanel(false); }
        });

        /* Teks ke suara: blok teks lalu lepas, atau klik elemen teks; fokus papan ketik membacakan labelnya */
        var BACA = 'h1,h2,h3,h4,h5,h6,p,li,td,th,dt,dd,blockquote,figcaption,label,a,button,summary';
        document.addEventListener('mouseup', function (e) {
            if (!state.tts || e.target.closest('#a11y-widget')) { return; }
            var sel = window.getSelection ? String(window.getSelection()) : '';
            if (sel.trim()) { bicara(sel); }
        });
        document.addEventListener('click', function (e) {
            if (!state.tts || e.target.closest('#a11y-widget')) { return; }
            if (window.getSelection && String(window.getSelection()).trim()) { return; }
            var el = e.target.closest(BACA);
            if (el) { bicara(el.getAttribute('aria-label') || el.innerText || el.textContent); }
        });
        document.addEventListener('focusin', function (e) {
            if (!state.tts || e.target.closest('#a11y-widget')) { return; }
            var el = e.target;
            bicara(el.getAttribute('aria-label') || el.getAttribute('title') || el.innerText || el.value || el.placeholder);
        });
        window.addEventListener('beforeunload', diam);

        terapkan();
    }

    // Terapkan secepat mungkin (juga bila skrip <head> tidak ada), lalu pasang panel setelah DOM siap
    terapkan();
    if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', siap); } else { siap(); }

    // Tab lain mengubah pilihan: ikuti
    window.addEventListener('storage', function (e) { if (e.key === KEY) { state = muat(); terapkan(); } });
})();
</script>
@endverbatim
