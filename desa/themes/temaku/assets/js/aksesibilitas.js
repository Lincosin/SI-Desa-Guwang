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
