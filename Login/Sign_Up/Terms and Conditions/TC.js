       function showContent(sectionId) {
            document.querySelectorAll('.content-section').forEach((section) => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';

            document.querySelectorAll('.sidebar ul li').forEach((tab) => {
                tab.classList.remove('active');
            });
            document.getElementById('tab' + sectionId.slice(-1)).classList.add('active');
        }
