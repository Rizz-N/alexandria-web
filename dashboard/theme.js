window.addEventListener('DOMContentLoaded', () => {
  const isDark = localStorage.getItem('darkMode') === 'true';
  document.body.classList.toggle('dark', isDark);
  document.querySelector('input[type="checkbox"]').checked = isDark;

  const fontSize = localStorage.getItem('fontSize');
  if (fontSize) {
    document.documentElement.style.setProperty('--user-font-size', fontSize + 'px');
    document.getElementById('font-size-value').innerText = fontSize + 'px';
    document.querySelector('input[type="range"][oninput*="font-size-value"]').value = fontSize;
  }

  const lineSpacing = localStorage.getItem('lineSpacing');
  if (lineSpacing) {
    document.documentElement.style.setProperty('--user-line-spacing', lineSpacing);
    document.getElementById('line-spacing-value').innerText = lineSpacing;
    document.querySelector('input[type="range"][oninput*="line-spacing-value"]').value = lineSpacing;
  }

  function updateLabel(isDark) {
    const label = document.getElementById("label-theme");
    if (label) {
      label.innerText = isDark ? "Enable light mode" : "Enable dark theme";
      label.style.color = isDark ? "#fff" : "#333";
    }
  }

  function updateIcons(isDark) {
    const icons = {
      "settings-icon": isDark ? "../assets/icon/white-setting.svg" : "../assets/icon/settings.svg",
      "icon-category": isDark ? "../assets/icon/arrow_drop_down_white.svg" : "../assets/icon/arrow_drop_down.svg",
      "back-icon": isDark ? "../assets/icon/arrow_back_white.svg" : "../assets/icon/arrow_back.svg",
      "theme": isDark ? "../assets/icon/light-mode.svg" : "../assets/icon/dark_mode.svg",
      "lineSpacing": isDark ? "../assets/icon/line-spacing-white.svg" : "../assets/icon/format_line_spacing.svg",
      "fontSize": isDark ? "../assets/icon/font-size-white.svg" : "../assets/icon/format_size.svg",
      "account": isDark ? "../assets/icon/account-white.svg" : "../assets/icon/account.svg",
      "bookmark-icon": isDark ? "../assets/icon/star-white.svg" : "../assets/icon/star.svg"
    };

    // Set dan simpan icon berdasarkan ID
    for (const [id, src] of Object.entries(icons)) {
      const el = document.getElementById(id);
      if (el) el.src = src;
      localStorage.setItem(`icon-${id}`, src);
    }

    // Tangani ikon class search-icon
    const searchSrc = isDark ? "../assets/icon/white-search.svg" : "../assets/icon/search.svg";
    const searchIcons = document.querySelectorAll(".search-icon");
    searchIcons.forEach(el => {
      el.src = searchSrc;
    });
    localStorage.setItem('icon-search-icon', searchSrc);
  }

  function applyStoredIcons() {
    const iconIds = ["settings-icon", "icon-category", "theme", "lineSpacing", "fontSize", "account"];
    iconIds.forEach(id => {
      const savedSrc = localStorage.getItem(`icon-${id}`);
      const element = document.getElementById(id);
      if (savedSrc && element) {
        element.src = savedSrc;
      }
    });

    // Terapkan ikon untuk class search-icon
    const savedSearchSrc = localStorage.getItem('icon-search-icon');
    if (savedSearchSrc) {
      const searchIcons = document.querySelectorAll(".search-icon");
      searchIcons.forEach(el => {
        el.src = savedSearchSrc;
      });
    }
  }

  // Jalankan saat halaman dimuat
  if (localStorage.getItem('icon-settings-icon') === null) {
    updateIcons(isDark);
  } else {
    applyStoredIcons();
  }

  updateLabel(isDark);

  // Event toggle dark mode
  document.querySelector('input[type="checkbox"]').addEventListener('change', (event) => {
    const isDark = event.target.checked;
    document.body.classList.toggle('dark', isDark);
    localStorage.setItem('darkMode', isDark);
    updateIcons(isDark);
    updateLabel(isDark);
  });
});
