
@extends('layouts.master')



@section('content')

<p>
    Для того чтобы написать глагол в ing форме, просто добавляйте окончание в конце глагола:
    <ul>
    <li>
        work - working
    </li>
    <li>
        play - playing
    </li>
    <li>
        open - opening.
    </li>
    </ul>
</p>

<strong style="color:darkred;font-size: 20px">Исключения:</strong>
<p>С = согласная; Г = гласная</p>
<div class="table" style="margin-bottom: 12px">
    <div class="table-row header-row" style="font-weight: 600">
        <div class="table-cell" style="word-break: break-word;">Если оканчивается на</div>
        <div class="table-cell">Сделай это</div>
        <div class="table-cell">И добавь</div>
        <div class="table-cell">Примеры</div>
    </div>
    <div class="table-row">
        <div class="table-cell">C + Г + С и ударный слог</div>
        <div class="table-cell">Удвой последнюю согласную</div>
        <div class="table-cell">ing</div>
        <div class="table-cell">stop, stopping, begin, beginning</div>
    </div>
    <div class="table-row">
        <div class="table-cell">C + e</div>
        <div class="table-cell">Убери e</div>
        <div class="table-cell">ing</div>
        <div class="table-cell">phone, phoning, dance, dancing, make, making</div>
    </div>
    <div class="table-row">
        <div class="table-cell">ie</div>
        <div class="table-cell">измени ie на y</div>
        <div class="table-cell">ing</div>
        <div class="table-cell">lie, lying, die, dying</div>
    </div>
</div>

<h4 style="text-align: center">Тренажер для отработки правила:</h4>

<ing-verb-training></ing-verb-training>
@endsection