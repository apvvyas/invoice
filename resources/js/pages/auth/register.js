var moment = require('moment-timezone');
$('input[name="timezone"]').val(moment.tz.guess())