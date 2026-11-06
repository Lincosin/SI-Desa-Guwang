/*
 * Tema Samudra - interaksi & animasi.
 * Ditulis tanpa ketergantungan (vanilla JS) supaya tetap berjalan saat CDN tidak tersedia.
 * Animasi hanya berjalan bila <html> memiliki kelas .smd-motion (lihat template.blade.php).
 */
(function () {
  'use strict';

  window.__smdReady = true;

  var doc = document.documentElement;
  var body = document.body;
  var motion = doc.classList.contains('smd-motion');
  var finePointer = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  var navbar = document.getElementById('smd-navbar');
  var drawer = document.getElementById('smd-drawer');
  var overlay = document.querySelector('.smd-overlay');
  var search = document.getElementById('smd-search');
  var toTop = document.getElementById('smd-totop');
  var loader = document.getElementById('smd-loader');
  var lastFocus = null;

  function $all(sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); }

  function setExpanded(name, value) {
    $all('[data-smd-toggle="' + name + '"]').forEach(function (btn) {
      btn.setAttribute('aria-expanded', value ? 'true' : 'false');
    });
  }

  // ------------------------------------------------------------------
  // Menu laci (ponsel)
  // ------------------------------------------------------------------
  $all('.smd-acc > li').forEach(function (li, i) { li.style.setProperty('--i', i); });

  function openDrawer() {
    if (!drawer) return;
    lastFocus = document.activeElement;
    overlay.hidden = false;
    requestAnimationFrame(function () {
      overlay.classList.add('is-open');
      drawer.classList.add('is-open');
    });
    drawer.setAttribute('aria-hidden', 'false');
    body.classList.add('smd-lock');
    setExpanded('drawer', true);
    var first = drawer.querySelector('input, button, a');
    if (first && finePointer) setTimeout(function () { first.focus(); }, 300);
  }

  function closeDrawer() {
    if (!drawer || !drawer.classList.contains('is-open')) return;
    overlay.classList.remove('is-open');
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    body.classList.remove('smd-lock');
    setExpanded('drawer', false);
    setTimeout(function () { overlay.hidden = true; }, 300);
    if (lastFocus) lastFocus.focus();
  }

  // ------------------------------------------------------------------
  // Panel pencarian
  // ------------------------------------------------------------------
  function toggleSearch(force) {
    if (!search) return;
    var show = typeof force === 'boolean' ? force : search.hidden;
    search.hidden = !show;
    setExpanded('search', show);
    if (show) {
      if (navbar) navbar.classList.remove('is-hidden');
      var input = search.querySelector('input');
      if (input) input.focus();
    }
  }

  // ------------------------------------------------------------------
  // Efek riak (ripple) saat diklik
  // ------------------------------------------------------------------
  function ripple(el, e) {
    if (!motion) return;
    var rect = el.getBoundingClientRect();
    var size = Math.max(rect.width, rect.height);
    var span = document.createElement('span');
    span.className = 'smd-ripple';
    span.style.width = span.style.height = size + 'px';
    span.style.left = (e.clientX - rect.left - size / 2) + 'px';
    span.style.top = (e.clientY - rect.top - size / 2) + 'px';
    el.appendChild(span);
    setTimeout(function () { span.remove(); }, 650);
  }

  document.addEventListener('click', function (e) {
    var rippleTarget = e.target.closest('.smd-btn, .smd-chip, .smd-quick__item, .smd-iconbtn');
    if (rippleTarget && e.clientX) ripple(rippleTarget, e);

    var toggle = e.target.closest('[data-smd-toggle]');
    if (toggle) {
      var name = toggle.getAttribute('data-smd-toggle');
      if (name === 'drawer') openDrawer();
      if (name === 'search') toggleSearch();
      return;
    }
    if (e.target.closest('[data-smd-close="drawer"]')) {
      closeDrawer();
      return;
    }
    // Akordeon menu laci
    var acc = e.target.closest('.smd-acc__toggle');
    if (acc) {
      var panel = acc.nextElementSibling;
      var open = acc.getAttribute('aria-expanded') === 'true';
      acc.setAttribute('aria-expanded', open ? 'false' : 'true');
      if (panel) panel.hidden = open;
      return;
    }
    // Tautan "#!" pada menu desktop tidak perlu memindahkan halaman
    if (e.target.closest('.smd-nav a[href="#!"]')) e.preventDefault();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeDrawer();
      if (search && !search.hidden) toggleSearch(false);
    }
    // Pintasan "/" untuk membuka pencarian
    if (e.key === '/' && !/input|textarea|select/i.test(document.activeElement.tagName)) {
      e.preventDefault();
      toggleSearch(true);
    }
  });

  // Menu desktop: buka submenu dengan Enter/Spasi pada tautan induk
  $all('.smd-nav .smd-has-sub > a').forEach(function (link) {
    link.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        var sub = link.parentElement.querySelector('.smd-sub a');
        if (sub) sub.focus();
      }
    });
  });

  window.addEventListener('resize', function () {
    if (window.innerWidth >= 1100) closeDrawer();
  });

  // ------------------------------------------------------------------
  // Tandai menu aktif sesuai halaman yang sedang dibuka
  // ------------------------------------------------------------------
  (function markActive() {
    var here = location.href.split('#')[0].replace(/\/+$/, '');
    var found = false;
    $all('.smd-nav a[href], .smd-acc a[href]').forEach(function (a) {
      var raw = a.getAttribute('href') || '';
      if (!raw || raw.charAt(0) === '#' || /^javascript:/i.test(raw)) return;
      var href = a.href.split('#')[0].replace(/\/+$/, '');
      if (href !== here) return;
      a.classList.add('is-active');
      found = true;
      var item = a.closest('.smd-nav__item');
      if (item) {
        var top = item.querySelector('.smd-nav__link');
        if (top) top.classList.add('is-active');
      }
    });
    if (!found) {
      var home = document.querySelector('.smd-nav__list > .smd-nav__item:first-child .smd-nav__link');
      var homeHref = home ? home.href.replace(/\/+$/, '') : '';
      if (home && here === homeHref) home.classList.add('is-active');
    }
  })();

  // ------------------------------------------------------------------
  // Gulir: bayangan & navbar pintar, bilah progres, tombol ke atas
  // ------------------------------------------------------------------
  var progress = null;
  if (motion) {
    progress = document.createElement('div');
    progress.className = 'smd-progress';
    progress.setAttribute('aria-hidden', 'true');
    body.appendChild(progress);
  }

  var lastY = window.scrollY || 0;
  var ticking = false;
  function onScroll() {
    var y = window.scrollY || window.pageYOffset;
    var max = Math.max(1, document.documentElement.scrollHeight - window.innerHeight);
    var ratio = Math.min(1, y / max);

    if (navbar) {
      navbar.classList.toggle('is-scrolled', y > 8);
      // Sembunyikan saat menggulir ke bawah, munculkan lagi saat ke atas
      var menuOpen = (search && !search.hidden) || navbar.matches(':hover') || navbar.contains(document.activeElement);
      if (motion && y > 320 && y > lastY + 4 && !menuOpen) navbar.classList.add('is-hidden');
      else if (y < lastY - 4 || y <= 320) navbar.classList.remove('is-hidden');
    }
    if (progress) progress.style.transform = 'scaleX(' + ratio + ')';
    if (toTop) {
      toTop.classList.toggle('is-visible', y > 600);
      toTop.style.setProperty('--p', Math.round(ratio * 100));
    }
    lastY = y;
    ticking = false;
  }
  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(onScroll);
      ticking = true;
    }
  }, { passive: true });
  onScroll();

  if (toTop) {
    toTop.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: motion ? 'smooth' : 'auto' });
    });
  }

  // ------------------------------------------------------------------
  // Jam digital di bilah atas
  // ------------------------------------------------------------------
  (function clock() {
    var el = document.querySelector('[data-smd-clock]');
    if (!el) return;
    var t = el.querySelector('time');
    var off = -new Date().getTimezoneOffset() / 60;
    var zona = off === 7 ? 'WIB' : off === 8 ? 'WITA' : off === 9 ? 'WIT' : '';
    function tick() {
      var d = new Date();
      var pad = function (n) { return (n < 10 ? '0' : '') + n; };
      t.textContent = pad(d.getHours()) + '.' + pad(d.getMinutes()) + '.' + pad(d.getSeconds()) + (zona ? ' ' + zona : '');
    }
    tick();
    el.hidden = false;
    setInterval(tick, 1000);
  })();

  // ------------------------------------------------------------------
  // Kata berganti di banner
  // ------------------------------------------------------------------
  $all('.smd-rotator[data-words]').forEach(function (rot) {
    var words = rot.getAttribute('data-words').split('|').filter(Boolean);
    var word = rot.querySelector('.smd-rotator__word');
    if (!word || words.length < 2) return;
    var i = 0;
    setInterval(function () {
      i = (i + 1) % words.length;
      if (!motion) { word.textContent = words[i]; return; }
      word.classList.remove('is-in');
      word.classList.add('is-out');
      setTimeout(function () {
        word.textContent = words[i];
        word.classList.remove('is-out');
        void word.offsetWidth;
        word.classList.add('is-in');
      }, 340);
    }, 2800);
  });

  // ------------------------------------------------------------------
  // Angka berjalan (count-up) & muncul saat digulir
  // ------------------------------------------------------------------
  var fmt = window.Intl ? new Intl.NumberFormat('id-ID') : { format: function (n) { return String(n); } };

  function countUp(el) {
    var target = parseInt(el.getAttribute('data-count'), 10) || 0;
    if (!motion || target === 0) { el.textContent = fmt.format(target); return; }
    var start = null;
    var dur = Math.min(2200, 900 + Math.log10(target + 1) * 300);
    function step(ts) {
      if (!start) start = ts;
      var p = Math.min(1, (ts - start) / dur);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt.format(Math.round(target * eased));
      if (p < 1) requestAnimationFrame(step);
    }
    el.textContent = '0';
    requestAnimationFrame(step);
  }

  var revealGroups = [
    // Beranda
    ['.smd-ticker', ''],
    ['.smd-shead', ''],
    ['.smd-tile', ''],
    ['.smd-shead__foot', ''],
    ['.smd-feature', ''],
    ['.smd-finder', 'smd-reveal--zoom'],
    ['.smd-offer', ''],
    ['.smd-cta-strip', 'smd-reveal--zoom'],
    ['.smd-quote', ''],
    ['.smd-plan', ''],
    ['.smd-mapcard', ''],
    ['.smd-faq', ''],
    ['.smd-final__inner', ''],
    // Halaman lain
    ['.smd-chips', ''],
    ['.smd-slider', 'smd-reveal--zoom'],
    ['.smd-headline', 'smd-reveal--zoom'],
    ['.smd-section-head', ''],
    ['.smd-post', ''],
    ['.smd-sidebar__search', ''],
    ['.smd-widget', ''],
    ['.smd-pagination', ''],
    ['.smd-apbdes > *', ''],
    ['.smd-footer__col', ''],
    ['.smd-main .content > p, .smd-main .content > figure, .smd-main .content > a', ''],
  ];


  if (motion && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        el.classList.add('is-revealed', 'is-seen');
        io.unobserve(el);
        // Lepas kelas reveal setelah selesai supaya efek hover kartu tidak ikut tertunda
        var wait = (parseInt(el.style.getPropertyValue('--rd'), 10) || 0) + 800;
        setTimeout(function () {
          el.classList.remove('smd-reveal', 'smd-reveal--zoom', 'is-revealed');
          el.style.removeProperty('--rd');
        }, wait);
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

    revealGroups.forEach(function (g) {
      var groupIndex = new Map();
      $all(g[0]).forEach(function (el) {
        // Jeda bertahap untuk elemen bersaudara (efek "stagger")
        var parent = el.parentElement;
        var n = groupIndex.get(parent) || 0;
        groupIndex.set(parent, n + 1);
        el.style.setProperty('--rd', Math.min(n, 6) * 80 + 'ms');
        el.classList.add('smd-reveal');
        if (g[1]) el.classList.add(g[1]);
        io.observe(el);
      });
    });

    var counterIO = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        countUp(en.target);
        counterIO.unobserve(en.target);
      });
    }, { threshold: 0.4 });
    $all('[data-count]').forEach(function (el) { counterIO.observe(el); });
  }

  // ------------------------------------------------------------------
  // Efek sorot (spotlight) mengikuti kursor pada kartu
  // ------------------------------------------------------------------
  if (motion && finePointer) {
    document.addEventListener('pointermove', function (e) {
      var card = e.target.closest && e.target.closest('.smd-spotlight');
      if (!card) return;
      var r = card.getBoundingClientRect();
      card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      card.style.setProperty('--my', (e.clientY - r.top) + 'px');
    }, { passive: true });
    // Kartu "Kantor Desa" di banner sengaja tidak ikut bergerak mengikuti kursor:
    // kartu kaca yang dimiringkan kehilangan efek blur di Chrome sehingga tampak pudar.
  }

  // ------------------------------------------------------------------
  // Gambar muncul halus setelah selesai dimuat
  // ------------------------------------------------------------------
  if (motion) {
    $all('.smd-post__media img, .smd-headline__img, .smd-slider__item img, .smd-main .content img').forEach(function (img) {
      if (img.complete && img.naturalWidth > 0) return; // sudah tampil, tidak perlu dianimasikan
      img.classList.add('smd-lazy');
      var done = function () { img.classList.add('is-loaded'); };
      img.addEventListener('load', done, { once: true });
      img.addEventListener('error', done, { once: true });
      setTimeout(done, 4000);
    });
  }

  // ------------------------------------------------------------------
  // Kaca buram tanpa backdrop-filter.
  // backdrop-filter memunculkan garis tegak/hitam di Chrome Windows dengan zoom
  // browser bukan 100%. Sebagai gantinya, di balik setiap kaca dipasang salinan
  // foto di belakangnya yang diburamkan dengan filter biasa, lalu digeser agar
  // segaris dengan foto aslinya. Tanpa JavaScript, kaca tetap berwarna biasa.
  // ------------------------------------------------------------------
  (function kacaBuram() {
    var TEPI = 48; // sama dengan ruang tepi di samudra.css (.smd-kaca__lapis)
    var daftar = [];
    var hero = document.querySelector('.smd-hero');
    var heroMedia = hero && hero.querySelector('.smd-hero__media');

    // Posisi el di halaman tanpa ikut transform (animasi masuk, hover)
    function posisiHalaman(el) {
      var x = 0, y = 0;
      while (el) {
        x += el.offsetLeft; y += el.offsetTop; el = el.offsetParent;
        if (el) { x += el.clientLeft; y += el.clientTop; }
      }
      return { x: x, y: y };
    }

    // Opsi: lepas = kaca menempel di layar (navbar); belakang = elemen tempat bingkai
    // disisipkan di dalam akar, untuk kaca yang tidak boleh menutupi lapisan di atas foto
    function pasang(el, akar, salin, opsi) {
      if (!el || !akar) return;
      opsi = opsi || {};
      var bingkai = document.createElement('div');
      var lapis = document.createElement('div');
      var pinggir = opsi.belakang ? null : salin();
      var isi = salin();
      bingkai.className = 'smd-kaca__bingkai' + (opsi.belakang ? ' smd-kaca__bingkai--belakang' : '');
      bingkai.setAttribute('aria-hidden', 'true');
      lapis.className = 'smd-kaca__lapis';
      if (pinggir) {
        pinggir.classList.add('smd-kaca__pinggir');
        lapis.appendChild(pinggir);
      }
      isi.classList.add('smd-kaca__salinan');
      lapis.appendChild(isi);
      bingkai.appendChild(lapis);
      if (opsi.belakang) {
        opsi.belakang.parentNode.insertBefore(bingkai, opsi.belakang.nextSibling);
      } else {
        el.insertBefore(bingkai, el.firstChild);
        el.classList.add('smd-kaca');
      }
      daftar.push({ el: el, akar: akar, bingkai: bingkai, pinggir: pinggir, lepas: !!opsi.lepas, belakang: !!opsi.belakang });
    }

    function atur() {
      daftar.forEach(function (k) {
        var g = getComputedStyle(k.el);
        var w = k.akar.clientWidth, h = k.akar.clientHeight;
        var p;
        if (k.lepas) {
          var r1 = k.akar.getBoundingClientRect(), r2 = k.el.getBoundingClientRect();
          p = { x: r2.left - r1.left - k.akar.clientLeft, y: r2.top - r1.top - k.akar.clientTop };
        } else {
          var a = posisiHalaman(k.akar), b = posisiHalaman(k.el);
          p = { x: b.x - a.x - k.akar.clientLeft, y: b.y - a.y - k.akar.clientTop };
        }
        var s = k.bingkai.style;
        // Di dalam kaca, bingkai menempati area di dalam garis tepi kaca
        var bl = k.belakang ? 0 : parseFloat(g.borderLeftWidth) || 0;
        var bt = k.belakang ? 0 : parseFloat(g.borderTopWidth) || 0;
        if (k.belakang) {
          s.left = p.x + 'px';
          s.top = p.y + 'px';
          s.width = k.el.offsetWidth + 'px';
          s.height = k.el.offsetHeight + 'px';
        }
        s.setProperty('--kx', (p.x + bl) + 'px');
        s.setProperty('--ky', (p.y + bt) + 'px');
        s.setProperty('--kw', w + 'px');
        s.setProperty('--kh', h + 'px');
        s.borderRadius = Math.max(0, (parseFloat(g.borderTopLeftRadius) || 0) - bt) + 'px';
        if (k.pinggir) {
          // Salinan cadangan, diperbesar tepat sejauh TEPI, mengisi ruang di luar foto agar
          // tepi blur tidak memudar. Hanya perlu bila kaca dekat tepi foto (navbar, layar ponsel).
          s.setProperty('--ksx', (1 + 2 * TEPI / Math.max(1, w)).toFixed(4));
          s.setProperty('--ksy', (1 + 2 * TEPI / Math.max(1, h)).toFixed(4));
          var dekat = p.x < TEPI || p.y < TEPI || p.x + k.el.offsetWidth > w - TEPI || p.y + k.el.offsetHeight > h - TEPI;
          k.pinggir.style.display = dekat ? '' : 'none';
        }
      });
    }

    // Banner: navbar, kartu Kantor Desa, bilah statistik, label sambutan, tombol kaca
    if (heroMedia) {
      var salinHero = function () {
        var c = heroMedia.cloneNode(true);
        c.removeAttribute('aria-hidden');
        return c;
      };
      if (navbar && body.classList.contains('smd-has-hero')) pasang(navbar, hero, salinHero, { lepas: true });
      [hero.querySelector('.smd-hero__card'), hero.querySelector('.smd-statbar'), hero.querySelector('.smd-hero__eyebrow')]
        .concat($all('.smd-hero__cta .smd-btn--glass', hero))
        .forEach(function (el) { pasang(el, hero, salinHero); });
    }

    // Kartu berita bergambar
    $all('.smd-tile').forEach(function (tile) {
      var img = tile.querySelector('.smd-tile__img');
      var gaya = getComputedStyle(tile);
      var bayang = getComputedStyle(tile, '::after').backgroundImage;
      pasang(tile.querySelector('.smd-tile__body'), tile, function () {
        var c = document.createElement('div');
        c.style.backgroundColor = gaya.backgroundColor;
        c.style.backgroundImage = gaya.backgroundImage;
        if (img) {
          var i = img.cloneNode(false);
          i.alt = '';
          c.appendChild(i);
        }
        var redup = document.createElement('div');
        redup.className = 'smd-kaca__redup';
        redup.style.backgroundImage = bayang;
        c.appendChild(redup);
        return c;
      });
    });

    // Tombol bulat di pita ajakan (aspirasi)
    $all('.smd-cta-strip').forEach(function (pita) {
      var gaya = getComputedStyle(pita);
      var bayang = getComputedStyle(pita, '::before').backgroundImage;
      pasang(pita.querySelector('.smd-cta-strip__play'), pita, function () {
        var c = document.createElement('div');
        ['backgroundColor', 'backgroundImage', 'backgroundSize', 'backgroundPosition'].forEach(function (k) { c.style[k] = gaya[k]; });
        var redup = document.createElement('div');
        redup.className = 'smd-kaca__redup';
        redup.style.backgroundImage = bayang;
        c.appendChild(redup);
        return c;
      });
    });

    // Bagian gelap "Layanan": hanya foto samarnya yang diburamkan, tepat di atas foto itu,
    // sehingga cahaya biru di atasnya dan warna kaca kartu tetap seperti biasa
    var gelap = document.querySelector('.smd-dark');
    var gelapImg = gelap && gelap.querySelector('.smd-dark__img');
    if (gelapImg) {
      var gelapGaya = getComputedStyle(gelap);
      var salinGelap = function () {
        var c = document.createElement('div');
        c.style.backgroundColor = gelapGaya.backgroundColor;
        c.style.backgroundImage = gelapGaya.backgroundImage;
        c.appendChild(gelapImg.cloneNode(false));
        return c;
      };
      // Kartu Layanan dan panel pencarian di dalam bagian ini
      $all('.smd-glass-dark', gelap).forEach(function (el) { pasang(el, gelap, salinGelap, { belakang: gelapImg }); });
    }

    if (!daftar.length) return;
    atur();

    // Animasi pada salinan (Ken Burns, cahaya biru) disamakan waktunya dengan aslinya
    function samakan(sel, akar) {
      if (!akar || !akar.getAnimations) return;
      var asli = $all(sel, akar).filter(function (el) { return !el.closest('.smd-kaca__bingkai'); });
      $all('.smd-kaca__lapis').forEach(function (lapis) {
        $all(sel, lapis).forEach(function (el, i) {
          var a = asli[i % asli.length] ? asli[i % asli.length].getAnimations() : [];
          el.getAnimations().forEach(function (b, j) {
            if (a[j] && a[j].currentTime !== null) b.currentTime = a[j].currentTime;
          });
        });
      });
    }
    samakan('.smd-hero__slide', heroMedia);

    var antre = false;
    function jadwal() {
      if (antre) return;
      antre = true;
      requestAnimationFrame(function () { antre = false; atur(); });
    }
    window.addEventListener('resize', jadwal, { passive: true });
    window.addEventListener('load', jadwal);
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(jadwal);
    if (window.ResizeObserver) {
      var ro = new ResizeObserver(jadwal);
      daftar.forEach(function (k) { ro.observe(k.el); ro.observe(k.akar); });
      $all('.smd-hero__text').forEach(function (el) { ro.observe(el); });
    }
    // Navbar menempel di atas saat digulir, jadi posisinya terhadap banner berubah
    if (daftar.some(function (k) { return k.lepas; })) {
      window.addEventListener('scroll', function () {
        if ((window.scrollY || window.pageYOffset) < 200) jadwal();
      }, { passive: true });
    }
  })();

  // ------------------------------------------------------------------
  // Banner: latar berganti (gambar latar + slider) dengan efek Ken Burns
  // ------------------------------------------------------------------
  (function heroSlides() {
    var media = document.querySelector('.smd-hero > .smd-hero__media');
    var bg = media && media.querySelector('.smd-hero__bg');
    if (!bg) return;
    var slides = $all('.smd-hero__slide', bg);
    // Salinan foto di balik kaca (lihat kacaBuram) ikut berganti bersama foto asli
    var bgs = [bg].concat($all('.smd-kaca__lapis .smd-hero__bg'));
    var sets = bgs.map(function (b) { return $all('.smd-hero__slide', b); });
    var each = function (i, fn) { sets.forEach(function (s) { if (s[i]) fn(s[i]); }); };
    var urlOf = function (el) {
      var m = (el.style.backgroundImage || '').match(/url\(["']?(.*?)["']?\)/);
      return m ? m[1] : null;
    };
    // Muat semua foto lebih dulu; foto pertama ditampilkan perlahan setelah siap
    var ready = slides.map(function () { return false; });
    var shown = function () { bgs.forEach(function (b) { b.classList.add('is-loaded'); }); };
    slides.forEach(function (el, i) {
      var url = urlOf(el);
      if (!url) {
        ready[i] = true;
        if (i === 0) shown();
        return;
      }
      var img = new Image();
      img.onload = img.onerror = function () {
        ready[i] = true;
        if (i === 0) shown();
      };
      img.src = url;
    });
    if (!slides.length) shown();
    setTimeout(shown, 2500);

    if (slides.length < 2 || !motion) return;
    var cur = 0;
    setInterval(function () {
      var next = (cur + 1) % slides.length;
      if (document.hidden || !ready[next]) return; // tunggu foto berikutnya selesai dimuat
      var prev = cur;
      // Foto lama tetap utuh di bawah, foto baru memudar masuk di atasnya
      each(prev, function (el) { el.classList.remove('is-active'); el.classList.add('is-prev'); });
      each(next, function (el) { el.classList.remove('is-zoom'); });
      void bg.offsetWidth; // mulai ulang efek zoom
      each(next, function (el) { el.classList.add('is-zoom', 'is-active'); });
      setTimeout(function () { each(prev, function (el) { el.classList.remove('is-prev', 'is-zoom'); }); }, 2400);
      cur = next;
    }, 8000);
  })();

  // ------------------------------------------------------------------
  // Kartu kantor: status buka/tutup mengikuti jam di perangkat pengunjung
  // ------------------------------------------------------------------
  (function officeStatus() {
    var el = document.querySelector('[data-smd-office]');
    if (!el) return;
    var text = el.querySelector('[data-smd-office-text]');
    var dot = el.querySelector('.smd-status');
    var toMin = function (hm) { var p = String(hm || '').split(':'); return (+p[0] || 0) * 60 + (+p[1] || 0); };
    var buka = toMin(el.getAttribute('data-buka'));
    var tutup = toMin(el.getAttribute('data-tutup'));
    if (!text || !(tutup > buka)) return;
    function update() {
      var d = new Date();
      var now = d.getHours() * 60 + d.getMinutes();
      if (now < buka) {
        text.textContent = 'Buka pukul ' + el.getAttribute('data-buka').replace(':', '.');
        dot.className = 'smd-status smd-status--open';
      } else if (now < tutup) {
        text.textContent = 'Sedang Buka';
        dot.className = 'smd-status smd-status--open';
      } else {
        text.textContent = 'Sudah Tutup';
        dot.className = 'smd-status smd-status--closed';
      }
    }
    update();
    setInterval(update, 60000);
  })();

  // ------------------------------------------------------------------
  // Korsel (suara warga): tombol geser & status ujung
  // ------------------------------------------------------------------
  $all('[data-smd-carousel]').forEach(function (car) {
    var track = car.querySelector('.smd-carousel__track');
    var prev = car.querySelector('[data-smd-prev]');
    var next = car.querySelector('[data-smd-next]');
    if (!track) return;
    function step() {
      var item = track.firstElementChild;
      return item ? item.getBoundingClientRect().width + 18 : track.clientWidth;
    }
    function sync() {
      var max = track.scrollWidth - track.clientWidth - 6;
      if (prev) prev.disabled = track.scrollLeft <= 6;
      if (next) next.disabled = track.scrollLeft >= max;
    }
    if (prev) prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: motion ? 'smooth' : 'auto' }); });
    if (next) next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: motion ? 'smooth' : 'auto' }); });
    track.addEventListener('scroll', sync, { passive: true });
    window.addEventListener('resize', sync);
    sync();
  });

  // ------------------------------------------------------------------
  // Panel pencarian: pilih kategori tanpa kata kunci -> buka halaman kategori
  // ------------------------------------------------------------------
  $all('[data-smd-finder]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      var input = form.querySelector('input[name="cari"]');
      var kat = form.querySelector('[data-smd-kategori]');
      var kata = input ? input.value.trim() : '';
      if (!kata && kat && kat.value) {
        e.preventDefault();
        location.href = form.getAttribute('data-kategori').replace(/\/+$/, '') + '/' + encodeURIComponent(kat.value);
      } else if (!kata) {
        e.preventDefault();
        if (input) input.focus();
      }
    });
  });

  // ------------------------------------------------------------------
  // FAQ: hanya satu jawaban terbuka pada satu waktu
  // ------------------------------------------------------------------
  $all('.smd-faq').forEach(function (faq) {
    var items = $all('details', faq);
    items.forEach(function (d) {
      d.addEventListener('toggle', function () {
        if (!d.open) return;
        items.forEach(function (o) { if (o !== d) o.open = false; });
      });
    });
  });

  // ------------------------------------------------------------------
  // Layar memuat
  // ------------------------------------------------------------------
  if (loader) {
    var hideLoader = function () { loader.classList.add('is-hidden'); };
    if (document.readyState === 'complete') hideLoader();
    else window.addEventListener('load', hideLoader);
    setTimeout(hideLoader, 4000);
  }
})();
