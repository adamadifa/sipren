@foreach ($biaya as $b)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$b->kodebiaya}}</td>
    <td>{{$b->jenjang}}</td>
    <td>{{$b->tingkat}}</td>
    <td>{{$b->tahunakademik}}</td>
    <th>
        <a href="/biaya/{{$b->kodebiaya}}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
    </th>
</tr>
@endforeach