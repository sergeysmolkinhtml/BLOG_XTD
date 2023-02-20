
@php
    /** @var \App\Models\BlogCategory $item */
@endphp

<div class="tab-pane"  role="tabpanel">
    <div class="form-group">
        <label for="category_id"> Category </label>
        <select name="category_id"
                id="category_id"
                class="form-control"
                placeholder="Choose category"
                required>
            @foreach($categoryList as $categoryOption)
            <option value="{{$categoryOption->id}}"
                    @if($categoryOption->id == $item->category_id) selected @endif>
                {{$categoryOption->id_title}}
            </option>
            @endforeach
        </select>
    </div>
</div>
