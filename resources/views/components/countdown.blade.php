<div x-data="{ timeLeft: {{ $timeLeft }}, handler: {{ $handler ?? 'null' }} }" x-init="() => {
            var duration = new Number(timeLeft);
            var start = new Date();
            var timer = setInterval(() => {
                timeLeft = duration - Math.floor((new Date() - start) / 1000);

                if(timeLeft == 0) {
                    clearInterval(timer);
                    handler && handler();
                }
            }, 500)
        }">
    {{ $slot }}
</div>
