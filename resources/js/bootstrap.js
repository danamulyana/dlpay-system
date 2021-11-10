window._ = require('lodash');

// Load plugins
import cash from "cash-dom";
import helper from "./helper";
import Velocity from "velocity-animate";
import * as Popper from "@popperjs/core";
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set plugins globally
window.cash = cash;
window.helper = helper;
window.Velocity = Velocity;
window.Popper = Popper;
window.$ = window.jQuery = require('jquery')

import 'select2';