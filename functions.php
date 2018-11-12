<?php
    //membuat koneksi
    $conn=mysqli_connect("localhost","root","","web");
    //Cek koneksi
    if(!$conn)
    {
        die('Koneksi Error : '.mysqli_connect_errno()
        .' - '.mysqli_connect_error());
    }
    //Ambil Data
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    
    //function query
    function query($query_kedua)
    {
        global $conn;
        $result = mysqli_query($conn,$query_kedua);
        $rows =[];
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[]=$row;
        }
        return $rows;
    }


    function hapus($id)
    {
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa WHERE Id =$id ");
        return mysqli_affected_rows($conn);
    }

    function edit ($data)
    {
        global $conn;

        $id=$data["id"];
        $nama=htmlspecialchars($data["Nama"]);
        $nim=htmlspecialchars($data["Nim"]);
        $email=htmlspecialchars($data["Email"]);
        $jurusan=htmlspecialchars($data["Jurusan"]);
        $gambar=htmlspecialchars($data["Gambar"]);

        $query= "UPDATE mahasiswa SET
               Nama ='$nama',
               NIm = '$nim',
               Email = '$email',
               Jurusan = '$jurusan',
               Gambar = '$gambar'
               WHERE id= $id";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }
    
    function cari ($keyword){

        $sql="SELECT * FROM mahasiswa
                WHERE 
                Nama LIKE '%$keyword%' OR
                Nim LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Jurusan LIKE '%$keyword%' 
                ";

        // kembalikan ke function query dengan parameter $sql
        return query($sql);

        // cat : pastikan $keyword pada line 61 terdapat petik satu karena nilainya berupa string
    }

?>