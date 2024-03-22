<x-app-layout>

    <div>
        <h2>Edit shop</h2>
    </div>

    <div>
        <a href="{{ route('shops.index') }}"> Back</a>
    </div>

    <form action="{{ route('shops.update', $shop->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <strong>Name:</strong>
            <input type="text" name="name" value="{{ $shop->name }}" placeholder="Name">
        </div>
        <div>
            <strong>Category:</strong>
            <select name="category_id">
                @foreach ($categories as $category)
                    @if ($category->id == $shop->category_id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <strong>avg_price_low:</strong>
            <input type="number" name="avg_price_low" value="{{ $shop->avg_price_low }}">
        </div>
        <div>
            <strong>avg_price_high:</strong>
            <input type="number" name="avg_price_high" value="{{ $shop->avg_price_high }}">
        </div>
        <div>
            <strong>Description:</strong>
            <textarea style="height:150px" name="description" placeholder="description">{{ $shop->description }}</textarea>
        </div>
        <div>
            <strong>open_time:</strong>
            <input type="time" name="open_time" value="{{ $shop->open_time }}">
        </div>
        <div>
            <strong>close_time:</strong>
            <input type="time" name="close_time" value="{{ $shop->close_time }}">
        </div>
        <div>
            <strong>holiday:</strong>
            <input type="text" name="holiday" value="{{ $shop->holiday }}" placeholder="holiday">
        </div>
        <div>
            <strong>address:</strong>
            <input type="text" name="address" value="{{ $shop->address }}" placeholder="Name">
        </div>
        <div>
            <strong>tel:</strong>
            <input type="tel" name="tel" value="{{ $shop->tel }}">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
