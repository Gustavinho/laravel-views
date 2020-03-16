<div>
  @include('laravel-views::filters')

  Mostrando {{ $total }} elementos
  <table>
    <thead class="">
      <tr>
        @foreach ($headers as $header)
          <td>{{ $header }}</td>
        @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach ($items as $item)
        <tr>
          @foreach ($view->row($item) as $column)
            <td>{!! $column !!}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $items->links() }}
</div>
