import './bootstrap';

import Alpine from 'alpinejs';

import { Dropdown, initMDB } from "mdb-ui-kit";

initMDB({ Dropdown });

window.Alpine = Alpine;

Alpine.start();
