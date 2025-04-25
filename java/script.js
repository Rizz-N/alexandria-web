const navbar = document.querySelector('.profile_picture');
const toggleButtons = [
  document.getElementById('profileToggle'),
  document.getElementById('profileToggleImg')
];

toggleButtons.forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    navbar.classList.toggle('active');
  });
});


document.addEventListener('click', function (e) {
  const menu = document.querySelector('.profile_picture');
  const isClickInside = toggleButtons.some(btn => btn.contains(e.target)) || menu.contains(e.target);

  if (!isClickInside) {
    navbar.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.left_nav .links');
  const contents = document.querySelectorAll('[id^="book"], [id^="favorite"], [id^="history"]');

  // Function to show content by ID
  function showContentById(id) {
      // Remove active state from all links
      links.forEach(link => link.classList.remove('active'));

      // Add active to the matching link
      links.forEach(link => {
          if (link.getAttribute('href').substring(1) === id) {
              link.classList.add('active');
          }
      });

      // Hide all content sections
      contents.forEach(content => {
          content.style.bottom = "-100%";
      });

      // Show target content
      const targetContent = document.getElementById(id);
      if (targetContent) {
          targetContent.style.bottom = "10px";
      }
  }

  // Set default content on load
  showContentById('book');

  // Add click event to each link
  links.forEach(link => {
      link.addEventListener('click', (e) => {
          e.preventDefault();
          const targetId = link.getAttribute('href').substring(1);
          showContentById(targetId);
      });
  });
});
