<style>.tinkoffPayRow{display:block;margin:1%;width:160px;}</style>
<script src="https://securepay.tinkoff.ru/html/payForm/js/tinkoff_v2.js"></script>
<form name="TinkoffPayForm" onsubmit="pay(this); return false;" class="form">
    <input class="tinkoffPayRow" type="hidden" name="terminalkey" value="1558686448245DEMO">
    <input class="tinkoffPayRow" type="hidden" name="frame" value="true">
    <input class="tinkoffPayRow" type="hidden" name="language" value="ru">
    <input class="tinkoffPayRow" type="text" placeholder="Сумма заказа" name="amount" id="amount" required>
    <input class="tinkoffPayRow" type="hidden" placeholder="Номер заказа" name="order">
    <input class="tinkoffPayRow" type="hidden" placeholder="Описание заказа" name="description">
    <input class="tinkoffPayRow" type="text" placeholder="ФИО плательщика" name="name" reqired>
    <input class="tinkoffPayRow" type="text" placeholder="E-mail" name="email" required>
    <input class="tinkoffPayRow phone" type="text" placeholder="Контактный телефон" name="phone" required>
    <input class="tinkoffPayRow main-bt green" style="padding: 0 12px; line-height: 40px; height: auto" type="submit" id="btn-pay" value="Оплатить">
</form>
