import './style.scss';

/* Скрипты по умолчанию */
import './components/_defaults/defaults';

import './components/slider/slider';
import './components/item/item';
import './components/catalog/catalog';

/* React */
import React from 'react';
import {render} from 'react-dom';

//import App from './components/cart/Cart';

render(<h1>Привет, мир!</h1>, document.querySelector('#cart-root'));


