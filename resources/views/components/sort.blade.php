@php
    $list = [];
    foreach ($columns as $key => $value) {
        array_push($list,
            ['value' => $key.'.asc','text' => $value.' crescente'],
            ['value' => $key.'.desc','text' => $value.' decrescente']
        );
    }
@endphp


<div class="form-group">
    <label>Ordenação</label>
    <select class="form-select" name="sort" id="">
    @foreach ($list as $item)
        <option value="{{$item['value']}}">{{$item['text']}}</option>
    @endforeach
    </select>
</div>
