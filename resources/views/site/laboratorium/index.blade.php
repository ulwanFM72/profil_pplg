<x-public-layout title="Laboratorium" description="Daftar laboratorium program keahlian">
    <x-section title="Laboratorium">@include('site.partials.lab-grid', ['labs' => $labs])</x-section>
</x-public-layout>
