import React, { Component } from 'react';
import { render } from 'react-dom';

export default class App extends Component {
  render() {
    return (
      <div className="cart">
        <div className="cart__content">
          <div className="cart-item">
            <div className="cart-item__col">
              <div className="cart-item__image">
                <img src="images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi.jpg" alt=""/>
              </div>
            </div>
            <div className="cart-item__col">
              <div className="cart-item__title">Наименование:</div>
              <div className="cart-item__name">
                <a href="">Мощевик Распятие Христово с предстоящими Покров Пресвятой Богородицы</a>
              </div>
              <div className="cart-item__price">10000</div>
            </div>
            <div className="cart-item__col">
              <div className="cart-item__title">Количество:</div>
              <div className="cart-item__number">
                <input type="number" min={1} max={10} placeholder="1"/>
              </div>
            </div>
            <div className="cart-item__col">
              <div className="cart-item__title">Сумма:</div>
              <div className="cart-item__total">10000</div>
            </div>
            <a href="" className="cart-item__remove" title="Удалить из корзины"></a>
          </div>
        </div>
        <div className="cart__aside">
          <div className="cart-nav">
            <ul className="cart-nav__list">
              <li className="is-active">Список покупок</li>
              <li>Контактные данные</li>
              <li>Доставка и оплата</li>
              <li>Сведения о заказе</li>
            </ul>
            <div className="cart-nav__panel">
              <div className="cart-nav__button">
                <a href="" className="button button--small button--red">Оформить заказ</a>
              </div>
              <div className="cart-nav__clear">
                <a href="">Очистить корзину</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  };
}

if (document.querySelector('#cart-root')) {
  render(<App/>, document.querySelector('#cart-root'));
}
