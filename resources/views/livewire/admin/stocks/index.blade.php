<div>
    @if ($step == StockStep::LIST_STOCKS)
        <livewire:user.stocks.list-stocks />
    @elseif ($step == StockStep::LIST_STOCK_ITEMS && $st)
        <livewire:user.stocks.list-stock-items :stock="$st" />
    @endif
</div>
