<x-app-layout>

    <div>
        <h2>Add New Product</h2>
    </div>

    <div>
        <a href="{{ route('shops.index') }}"> Back</a>
    </div>

    <form action="{{ route('shops.store') }}" method="POST">
        @csrf

        <div>
            <strong>Name:</strong>
            <input type="text" name="name" placeholder="Name">
        </div>
        <div>
            <strong>Category:</strong>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <strong>avg_price_low:</strong>
            <input type="number" name="avg_price_low" placeholder="Name">
        </div>
        <div>
            <strong>avg_price_high:</strong>
            <input type="number" name="avg_price_high" placeholder="Name">
        </div>
        <div>
            <strong>Description:</strong>
            <textarea style="height:150px" name="description" placeholder="Description"></textarea>
        </div>
        <div>
            <strong>open_time:</strong>
            <input type="time" name="open_time" placeholder="Name">
        </div>
        <div>
            <strong>close_time:</strong>
            <input type="time" name="close_time" placeholder="Name">
        </div>
        <div>
            <strong>holiday:</strong>
            <input type="text" name="holiday" placeholder="Name">
        </div>
        <div>
            <strong>address:</strong>
            <input type="text" name="address" placeholder="Name">
        </div>
        <div>
            <strong>tel:</strong>
            <input type="number" name="tel" placeholder="Price">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
