<?php
namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('about', [
        'title' => 'Tentang Kami',
        'content' => 'InfoTerkini.id adalah media digital independen yang berfokus pada penyajian berita aktual, objektif, dan dapat dipercaya. Didirikan pada tahun 2023 oleh sekelompok jurnalis muda, kami berkomitmen untuk memberikan informasi berkualitas dan berimbang kepada masyarakat Indonesia.
        
        Misi kami: 
            - Menyajikan berita yang akurat dan faktual
            - Menjadi wadah literasi digital dan media
            - Mendorong masyarakat untuk berpikir kritis dan terbuka
            - Mari bersama ciptakan media yang cerdas dan berintegritas!'
        ]);
    }

    public function contact()
    {
        return view('contact', [
        'title' => 'Halaman Kontak',
        'content' => 'Kami sangat terbuka untuk kritik, saran, maupun kerja sama. Silakan isi formulir di bawah ini atau hubungi kami melalui informasi berikut:

            📧 Email: xxxxx@infoterkini.id
            📱 WhatsApp: +62 812-xxxx-xxxx
            📍 Alamat: Jl. Merdeka No. xxx, Jakarta Pusat
            
            Terima kasih telah mempercayai InfoTerkini.id sebagai sumber informasi Anda!'
        ]);
    }

    public function artikel()
    {
        return view('artikel', [
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title' => 'Halaman FAQ',
            'content' => 'Ini adalah halaman FAQ yang menjelaskan tentang isi 
            halaman ini.'
            ]);
    }

    public function tos()
    {
        return view('tos', [
        'title' => 'Halaman TOS',
        'content' => 'Ini adalah halaman Terms of Service yang menjelaskan tentang isi 
        halaman ini.'
        ]);
    }
}