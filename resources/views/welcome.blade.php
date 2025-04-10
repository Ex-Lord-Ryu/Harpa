@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/tes.css') }}">

<div class="main-content">
    @include('components.navbar')

    <header id="home">
        <div class="left">
            <h1>Harpa Mulut – Saatnya UMKM Bersuara! <span>Gallery Bejo</span></h1>
            <p>Kami percaya bahwa setiap UMKM memiliki cerita unik.</p>
            <a href="#">
                <i class='bx bx-basket'></i>
                <span>Pesan Sekarang</span>
            </a>
        </div>
        <img src="{{ asset('assets/img/tp.png') }}">
    </header>

    <h2 id="promosi-unggulan" class="separator">
        Promosi Unggulan
    </h2>

    <div class="nft-shop">
        <div class="nft-list">
            <div class="item">
                <img src="{{ asset('assets/img-assets/karinding.jpg') }}">
                <div class="info">
                    <div>
                        <h5>Karinding</h5>
                        <div class="btc">
                            <p>150.000</p>
                        </div>
                    </div>
                </div>
                <div class="bid">
                    <a href="{{ url('booking-form')}}?productName=Karinding&productPrice=150000">Pesan Sekarang</a>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets/img-assets/nuthul.jpg') }}">
                <div class="info">
                    <div>
                        <h5>Nuthul</h5>
                        <div class="btc">
                            <p>150.000</p>
                        </div>
                    </div>
                </div>
                <div class="bid">
                    <a href="{{ url('booking-form')}}?productName=Nuthul&productPrice=150000">Pesan Sekarang</a>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets/img-assets/rinding-mlg.jpg') }}">
                <div class="info">
                    <div>
                        <h5>Rinding-Mlg</h5>
                        <div class="btc">
                            <p>150.000</p>
                        </div>
                    </div>
                </div>
                <div class="bid">
                    <a href="{{ url('booking-form')}}?productName=Rinding-Malang&productPrice=150000">Pesan Sekarang</a>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets/img-assets/karinding (2).jpg') }}">
                <div class="info">
                    <div>
                        <h5>Towel</h5>
                        <div class="btc">
                            <p>150.000</p>
                        </div>
                    </div>
                </div>
                <div class="bid">
                    <a href="{{ url('booking-form')}}?productName=Towel&productPrice=150000">Pesan Sekarang</a>
                </div>
            </div>
            <!-- Other product items - empty images replaced with placeholders -->
            <div class="item">
                <img src="{{ asset('img/img-assets/karinding (2).jpg') }}">
                <div class="info">
                    <div>
                        <h5>Produk</h5>
                        <div class="btc">
                            <p>150.000</p>
                        </div>
                    </div>
                </div>
                <div class="bid">
                    <a href="{{ url('booking-form')}}">Pesan Sekarang</a>
                </div>
            </div>
            <!-- Repeat for remaining product items -->
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>

        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.291823424536!2d112.60701217386206!3d-7.968763192056161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788285c228f26f%3A0xf13c282db677a0b1!2sJl.%20Singgalang%20No.5%2C%20Pisang%20Candi%2C%20Kec.%20Sukun%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065146!5e0!3m2!1sid!2sid!4v1689173406403!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map">
            </iframe>
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" name="name" placeholder="nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" name="phone" placeholder="no hp">
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <footer>
        <h3>Create, Explore, Find & Collect Your Want Here</h3>
        <div class="right">
            <div class="links">
                <a href="#">Privacy Policy</a>
                <a href="#">Cooperation</a>
                <a href="#">Sponsorship</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="social">
                <i class='bx bxl-instagram'></i>
                <i class='bx bxl-facebook-square'></i>
                <i class='bx bxl-github'></i>
            </div>
            <p>Copyright © {{ date('Y') }} Gallery Bejo, All Rights Reserved.</p>
        </div>
    </footer>
</div>
@endsection

@section('styles')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/tes.css') }}">
@endsection

@section('scripts')
<script src="https://unpkg.com/feather-icons"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>
@endsection
