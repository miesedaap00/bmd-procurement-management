import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    // Sidebar
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebarToggle && sidebar && mainContent) {

        sidebarToggle.addEventListener('click', () => {

            sidebar.classList.toggle('-translate-x-full');

            mainContent.classList.toggle('ml-64');
            mainContent.classList.toggle('ml-0');

        });

    }


    // Profile
    const profileToggle = document.getElementById('profile-toggle');
    const profileMenu = document.getElementById('profile-menu');

    if (profileToggle && profileMenu) {

        profileToggle.addEventListener('click', (event) => {

            event.stopPropagation();

            profileMenu.classList.toggle('hidden');

        });


        document.addEventListener('click', (event) => {

            if (
                !profileMenu.contains(event.target) &&
                !profileToggle.contains(event.target)
            ) {

                profileMenu.classList.add('hidden');

            }

        });

    }

});