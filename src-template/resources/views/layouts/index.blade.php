<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Blog Guru</title>
    <link rel="stylesheet" href="css/frontend.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Blog Guru</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="showcase">
        <div class="container">
            <h1>Welcome to My Blog</h1>
            <p>Discover insights and stories from the world of education.</p>
        </div>
    </section>

    <section class="main">
            
     
        <div class="container">
            <h2>Profil Guru</h2>
            <div class="info">
                @foreach ($guru as $g)  
                <div class="info-box">
                    <h3>Gambar</h3>
                    <img src="{{ $g->getFirstMediaUrl('image','priview') }}" alt="" class="profile-image">
                </div>
                {{-- @endforeach
                @foreach ($guru as $gu) --}}
                <div class="info-box">
                    <h3>Nama</h3>
                    <p>{{ $g->nama_guru }}</p>
                    <h3>Tempat Tanggal Lahir</h3>
                    <p>{{ $g->ttl }}</p>
                    <!-- <div class="info-box"> -->
                        <h3>Deskripsi</h3>
                        <p>{{ $g->description }}</p>
                    <!-- </div> -->
                    <h3>Riwayat Pendidikan Terakhir</h3>
                    <p>{{ App\Models\Datagu::RIWAYAT_PENDIDIKAN[$g->riwayat_pendidikan] ?? '' }}</p>
                    <h3>lulusan </h3>
                    <p>{{ $g->universitas }}</p>
                    <h3>Mata Pelajaran</h3>
                    <p>{{ $g->mata_pelajaran }}</p>
                </div>
                @endforeach
                <!-- <div class="info-box">
                    <h3>Riwayat Pendidikan Terakhir</h3>
                    <p>S2</p>
                </div>
                <div class="info-box">
                    <h3>Mata Pelajaran</h3>
                    <p>Matematika</p>
                </div> -->
               
            </div>
        </div>
    </section>

    <footer>
        <p>Blog Guru &copy; 2024</p>
    </footer>
</body>
</html>
