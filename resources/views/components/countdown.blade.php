<div x-data="{ duration: {{ $duration }}, timeLeft: {{ $duration }}  }" x-init="() => {
            timeLeft = new Number(duration);
            var start = new Date();
            var timer = setInterval(() => {
                timeLeft = duration - Math.floor((new Date() - start) / 1000);

                if(timeLeft == 0) {
                    clearInterval(timer);
                    $dispatch('timeup');
                }
            }, 100/3)
        }" @timeup="{{ $timeup ?? 'console.log(\'timeup!\')' }}">
    {{ $slot }}
</div>
