
<div class="form-group">
    <label for="parent_id">Select Category Level</label>
    <select name="parent_id" id="parent_id"class="form-control">
        <option value="0" @if(isset($category['parent_id']) && $category['parent_id'] == 0) selected="" @endif>Main Category</option>
        @if(!empty($getCategories))
            @foreach($getCategories as $parentcategory)
                <option value="{{ $parentcategory['id'] }}" @if(isset($category['parent_id']) && $category['parent_id'] == $parentcategory['id']) selected="" @endif>{{ $parentcategory['category_name'] }}</option>
                @if(!empty($parentcategory['subcategories']))
                    @foreach($parentcategory['subcategories'] as $subcategories)
                    <option value="{{ $subcategories['id'] }}" @if(isset($category['parent_id']) && $category['parent_id'] == $subcategories['id']) selected="" @endif>&nbsp;&raquo;&nbsp;{{ $subcategories['category_name'] }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>