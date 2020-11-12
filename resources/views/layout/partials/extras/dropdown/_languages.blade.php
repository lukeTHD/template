{{-- Nav --}}
<ul class="navi navi-hover py-4">
    {{-- Item --}}
    <li class="navi-item {{(app()->getLocale() == 'en') ? 'navi-item-active' : ''}}">
        <a href="{{route('user.get.setLanguage',['locale' =>'en'])}}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt=""/>
            </span>
            <span class="navi-text">English</span>
        </a>
    </li>
    {{-- Item --}}
    <li class="navi-item {{(app()->getLocale() == 'vi') ? 'navi-item-active' : ''}} ">
        <a href="{{route('user.get.setLanguage',['locale' =>'vi'])}}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/220-vietnam.svg') }}" alt=""/>
            </span>
            <span class="navi-text">VietNam</span>
        </a>
    </li>
</ul>
