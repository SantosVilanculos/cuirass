import '@tabler/core/dist/js/tabler.min.js';
import Swal from 'sweetalert2';

document.addEventListener('livewire:init', () => {
    Livewire.on(
        'message',
        ({ titleText = undefined, text = undefined, icon = undefined, timer = 3_000, showCloseButton = false }) => {
            // titleText?: string | undefined
            // text?: string | undefined
            // icon?: string<'success' | 'error' | 'warning' | 'info' | 'question'> | undefined
            // timer?: number | undefined
            // showCloseButton?: boolean | undefined

            Swal.fire({
                titleText,
                text,
                icon,
                toast: true,
                position: 'bottom',
                timer,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton,
                didOpen: popup => {
                    popup.onmouseenter = Swal.stopTimer;
                    popup.onmouseleave = Swal.resumeTimer;
                }
            });
        }
    );
});
