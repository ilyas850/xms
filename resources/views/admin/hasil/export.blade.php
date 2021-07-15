<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Soal</th>
      <th>Tipe Tes</th>
      <th>Opsi</th>
      <th>Jawaban</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    @php $i=1 @endphp
    @foreach ($jawab as $keyj)
        <tr>
          <td><center>{{$i++}}</center></td>
          <td>{{$keyj->soal}}</td>
          <td>{{$keyj->tipe_test}}</td>
          <td><center>{{$keyj->opsi}}</center></td>
          <td>{{$keyj->jawaban}}</td>
          <td><center>
            @if ($keyj->b_s == 'B')
              Benar
            @elseif ($keyj->b_s == 'S')
              Salah
            @endif
          </center></td>
        </tr>

    @endforeach
  </tbody>
</table>
