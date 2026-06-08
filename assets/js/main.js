/* ═══════════════════════════════════════════════════════
   EduHub – main.js
   Interactive UI only. PHP handles all data & routing.
   No framework required — pure vanilla JS.

   Features handled here:
   1. Mobile nav drawer (hamburger open/close)
   2. Tab switching (data-tabs / data-tab / data-tab-panel)
   3. Accordion expand/collapse (data-accordion)
   4. Filter chips (data-filter-group) — visual only
   5. Toggle switches (.toggle)
   6. Quiz option radio selection (.quiz-option)
   7. Difficulty / question-type option highlight
   8. Scroll-to-top on question dot navigation
═══════════════════════════════════════════════════════ */

(function () {
  'use strict';

  /* ─── 1. MOBILE NAV ─────────────────────────────── */
  var hamburger = document.getElementById('hamburger');
  var mobileNav = document.getElementById('mobileNav');

  function openNav() {
    mobileNav.style.display = 'block';
    // small tick so display:block is painted before transition
    requestAnimationFrame(function () {
      mobileNav.classList.add('open');
    });
    hamburger.classList.add('open');
    hamburger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeNav() {
    mobileNav.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    // hide after CSS transition (300ms)
    setTimeout(function () {
      if (!mobileNav.classList.contains('open')) {
        mobileNav.style.display = 'none';
      }
    }, 320);
  }

  if (hamburger && mobileNav) {
    // initialise hidden
    mobileNav.style.display = 'none';

    hamburger.addEventListener('click', function () {
      if (mobileNav.classList.contains('open')) {
        closeNav();
      } else {
        openNav();
      }
    });

    // close on backdrop click
    mobileNav.addEventListener('click', function (e) {
      if (e.target === mobileNav) closeNav();
    });

    // close on ESC
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeNav();
    });

    // close when a nav link is tapped (SPA-style feel)
    mobileNav.querySelectorAll('.mobile-nav-link').forEach(function (link) {
      link.addEventListener('click', function () {
        closeNav();
      });
    });
  }

  /* ─── 2. TABS ───────────────────────────────────── */
  document.querySelectorAll('[data-tabs]').forEach(function (tabGroup) {
    var links  = tabGroup.querySelectorAll('.tab-link');
    // panels can be siblings of the tabs container or children of a parent
    var panelContainer = tabGroup.closest('[data-tab-container]') || tabGroup.parentElement;
    var panels = panelContainer.querySelectorAll('.tab-panel');

    links.forEach(function (link) {
      link.addEventListener('click', function () {
        var target = link.dataset.tab;
        links.forEach(function (l)  { l.classList.remove('active'); });
        link.classList.add('active');
        panels.forEach(function (p) {
          p.classList.toggle('active', p.dataset.tabPanel === target);
        });
      });
    });
  });

  /* ─── 3. ACCORDION ──────────────────────────────── */
  // Works for both [data-accordion] groups AND standalone .accordion-header elements
  document.querySelectorAll('.accordion-header').forEach(function (header) {
    header.addEventListener('click', function () {
      var body   = header.nextElementSibling;
      var isOpen = header.classList.contains('open');
      var group  = header.closest('[data-accordion]');

      // collapse all siblings in same group
      if (group) {
        group.querySelectorAll('.accordion-header').forEach(function (h) {
          h.classList.remove('open');
          if (h.nextElementSibling) h.nextElementSibling.classList.remove('open');
        });
      }

      if (!isOpen) {
        header.classList.add('open');
        if (body) body.classList.add('open');
      }
    });
  });

  /* ─── 4. FILTER CHIPS (visual feedback) ─────────── */
  document.querySelectorAll('[data-filter-group]').forEach(function (group) {
    var chips = group.querySelectorAll('.filter-chip');
    chips.forEach(function (chip) {
      chip.addEventListener('click', function () {
        chips.forEach(function (c) { c.classList.remove('active'); });
        chip.classList.add('active');
        // PHP will handle the actual filtering via GET params on form submit.
        // For pure visual response, optionally dispatch a custom event:
        group.dispatchEvent(new CustomEvent('filterchange', {
          bubbles: true,
          detail: { filter: chip.dataset.filter || chip.textContent.trim() }
        }));
      });
    });
  });

  /* Same for review-tab buttons on quiz-results */
  document.querySelectorAll('.review-tab').forEach(function (tab) {
    var siblings = tab.closest('div').querySelectorAll('.review-tab');
    tab.addEventListener('click', function () {
      siblings.forEach(function (s) { s.classList.remove('active'); });
      tab.classList.add('active');
    });
  });

  /* custom added */

  // Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  const filterContainer = document.querySelector('[data-filter-group]');
  if (!filterContainer) return;

  const tabs = filterContainer.querySelectorAll('.review-tab');
  const reviewItems = document.querySelectorAll('.review-q');

  // Helper: get status from the .q-status element inside each review-q
  function getQuestionStatus(reviewQ) {
    const statusDiv = reviewQ.querySelector('.q-status');
    if (!statusDiv) return 'unknown';

    const text = statusDiv.innerText.trim();
    if (text.includes('✅ Correct')) return 'correct';
    if (text.includes('❌ Incorrect')) return 'wrong';
    if (text.includes('🙄 Not answered')) return 'not_answered';
    return 'wrong'; // fallback
  }

  // Update tab counts based on current DOM
  function updateTabCounts() {
    let allCount = reviewItems.length;
    let correctCount = 0;
    let wrongCount = 0;
    let notAnsweredCount = 0;

    reviewItems.forEach(item => {
      const status = getQuestionStatus(item);
      if (status === 'correct') correctCount++;
      else if (status === 'wrong') wrongCount++;
      else if (status === 'not_answered') notAnsweredCount++;
    });

    // Update tab labels (preserve icons and formatting)
    tabs.forEach(tab => {
      const filter = tab.getAttribute('data-filter');
      if (filter === 'all') {
        tab.innerHTML = `All (${allCount})`;
      } else if (filter === 'correct') {
        tab.innerHTML = `✅ Correct (${correctCount})`;
      } else if (filter === 'wrong') {
        // Combine "wrong" + "not answered" under the ❌ Wrong tab
        tab.innerHTML = `❌ Wrong (${wrongCount + notAnsweredCount})`;
      }
    });
  }

  // Filter questions based on selected tab
  function filterQuestions(filter) {
    reviewItems.forEach(item => {
      const status = getQuestionStatus(item);
      let show = false;

      if (filter === 'all') {
        show = true;
      } else if (filter === 'correct') {
        show = (status === 'correct');
      } else if (filter === 'wrong') {
        show = (status === 'wrong' || status === 'not_answered');
      }

      item.style.display = show ? '' : 'none';
    });
  }

  // Add click handlers to tabs
  tabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
      e.preventDefault();
      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove('active'));
      // Add active class to the clicked tab
      this.classList.add('active');

      const filter = this.getAttribute('data-filter');
      filterQuestions(filter);
    });
  });

  // Initialize: update counts and show all questions
  updateTabCounts();
  filterQuestions('all');
});

  /* ─── 5. TOGGLE SWITCHES ────────────────────────── */
  document.querySelectorAll('.toggle').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      toggle.classList.toggle('on');
      // PHP form: update via AJAX or form submit when saving
    });
  });

  /* ─── 6. QUIZ OPTION SELECTION ──────────────────── */
  document.querySelectorAll('.quiz-options-grid').forEach(function (grid) {
    var options = grid.querySelectorAll('.quiz-option');
    options.forEach(function (option) {
      option.addEventListener('click', function () {
        // deselect all in same grid
        options.forEach(function (o) {
          var r = o.querySelector('input[type="radio"]');
          if (r) r.checked = false;
        });
        var radio = option.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
        // CSS :has() handles the visual — no extra class needed
        // But for browsers without :has() support, add a class too:
        options.forEach(function (o) { o.classList.remove('selected'); });
        option.classList.add('selected');
      });
    });
  });

  /* ─── 7. DIFFICULTY OPTION HIGHLIGHT ────────────── */
  document.querySelectorAll('.diff-grid').forEach(function (grid) {
    var opts = grid.querySelectorAll('.diff-option');
    opts.forEach(function (opt) {
      opt.addEventListener('click', function () {
        opts.forEach(function (o) { o.classList.remove('active'); });
        opt.classList.add('active');
        var radio = opt.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
      });
    });
  });

  /* ─── 7b. QUESTION TYPE CHECKBOX HIGHLIGHT ───────── */
  document.querySelectorAll('.qtype-opt').forEach(function (opt) {
    opt.addEventListener('click', function () {
      opt.classList.toggle('active');
      var cb = opt.querySelector('input[type="checkbox"]');
      if (cb) cb.checked = !cb.checked;
    });
  });

  /* ─── 8. QUESTION DOT NAVIGATION ────────────────── */
  document.querySelectorAll('.q-dot-nav').forEach(function (dot) {
    dot.addEventListener('click', function () {
      // PHP will load the correct question via GET param ?q=N
      // JS just smoothly scrolls to the top of the quiz card
      var card = document.querySelector('.quiz-card');
      if (card) card.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  /* ─── SMOOTH REVEAL ON SCROLL (intersection observer) */
  if ('IntersectionObserver' in window) {
    var revealEls = document.querySelectorAll('.anim-fade-up, .anim-fade');
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    revealEls.forEach(function (el) {
      el.style.animationPlayState = 'paused';
      observer.observe(el);
    });
  }

})();
