import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {


    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebarToggle && sidebar && mainContent) {

        sidebarToggle.addEventListener('click', function () {

            const isClosed = sidebar.dataset.closed === 'true';

            if (isClosed) {

                sidebar.style.transform = 'translateX(0)';
                mainContent.style.marginLeft = '16rem';

                sidebar.dataset.closed = 'false';

            } else {

                sidebar.style.transform = 'translateX(-100%)';
                mainContent.style.marginLeft = '0';

                sidebar.dataset.closed = 'true';

            }

        });

    }


    const profileToggle = document.getElementById('profile-toggle');
    const profileMenu = document.getElementById('profile-menu');

    if (profileToggle && profileMenu) {

        profileToggle.addEventListener('click', function (event) {

            event.stopPropagation();

            profileMenu.classList.toggle('hidden');

        });


        document.addEventListener('click', function (event) {

            if (
                !profileMenu.contains(event.target) &&
                !profileToggle.contains(event.target)
            ) {

                profileMenu.classList.add('hidden');

            }

        });

    }

});