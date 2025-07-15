@foreach($socialMediaLinks as $platform => $link)
    @if($link && $link != '#')
         <li>
            <a href="{{ $link }}"><i class="fa-brands fa-{{ $platform }} fs-4"></i></a>
        </li>
    @endif
@endforeach


