
    <table class="table table-bordered rounded">
      <thead class="rounded">
        <tr class="text-center rounded table_title_color">
          <th scope="col"><i class="far fa-list-alt"></i></th>
          <th scope="col">Counter Name</th>
          <th scope="col">Status</th>
          <th scope="col">Change</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
    
    
      <tbody>
    
           @foreach($data as $row)
             <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->status }}</td>
             </tr>
             @endforeach
      
      </tbody>
    </table>
    {!! $data->links() !!}
    </div>