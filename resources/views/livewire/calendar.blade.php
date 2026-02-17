<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div id='calendar' wire:ignore></div>
            </div>
        </div>
    </div>

    @assets
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    @endassets

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($this->events),
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\nPet: ' + info.event.extendedProps.pet);
                }
            });
            calendar.render();
        });
    </script>
    @endscript
</div>
