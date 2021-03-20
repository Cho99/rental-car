 <table id="table2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="table2_info">
     <thead>
         <tr role="row">
             <th class="sorting_asc" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-sort="ascending"
                 aria-label="Rendering engine: activate to sort column descending">
                 {{ trans('admin.stt') }} </th>
             <th class="sorting" tabindex="0" aria-controls="table2" rowspan="1" colspan="1"
                 aria-label="Browser: activate to sort column ascending">
                 {{ trans('category.trademark') }}</th>
             <th class="sorting" tabindex="0" aria-controls="table2" rowspan="1" colspan="1"
                 aria-label="Platform(s): activate to sort column ascending">
                 {{ trans('admin.actions') }}</th>
         </tr>
     </thead>
     <tbody id="table">
         @php($index = 1)
             @foreach ($categories as $category)
                 <tr role="row" class="odd">
                     <td class="sorting_1">{{ $index++ }}</td>
                     <td>{{ $category->name }}</td>
                     <td class="td general">
                         <a href="{{ route('admin.categories.show', $category->id) }}"><i class="fa fa-eye"></i></a>
                         <a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-pencil"></i></a>
                         <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                             class="delete delete-form general" id="delete_{{ $category->id }}">
                             @method('DELETE')
                             @csrf
                             <button type="submit">
                                 <i class="fa fa-trash"></i>
                             </button>
                         </form>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
     <script>
        $(function() {
            $('#table2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>