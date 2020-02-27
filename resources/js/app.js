import Echo from 'laravel-echo';

window.pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: "pusher",
  key: process.env.MIX_PUSHER_APP_KEY,
  wsHost: window.location.hostname,
  wsPort: 6001,
  disableStats: true,
});
