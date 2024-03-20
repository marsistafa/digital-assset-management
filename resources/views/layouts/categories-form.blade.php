<form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
    @csrf
    @isset($category)
        @method('PUT')
    @endisset

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="date_created">Date Created:</label>
        <input type="date" name="date_created" id="date_created" class="form-control" value="{{ old('date_created', isset($category) ? $category->date_created : '') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
    </div>
</form>
