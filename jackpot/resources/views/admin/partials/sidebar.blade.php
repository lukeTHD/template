<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
         data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav ">
            @can('dashboard-index')
                <li class="kt-menu__item  {{ active_sidebar('admin.dashboard.index') }}" aria-haspopup="true"><a
                        href="{{ route('admin.dashboard.index') }}"
                        class="kt-menu__link "><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<path
                                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
													<path
                                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg></span><span
                            class="kt-menu__link-text">{{ __('label.dashboard') }}</span></a></li>
            @endcan
            @canany(['user-index','user-create'])
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.users.index','admin.users.create','admin.users.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px"
                         viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.user.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('user-create')
                                <li class="kt-menu__item {{ active_sidebar('admin.users.create') }}"
                                    aria-haspopup="true"><a
                                        href="{{ route('admin.users.create') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.user.add') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                            @can('user-index')
                                <li class="kt-menu__item {{ active_sidebar('admin.users.index') }}"
                                    aria-haspopup="true"><a
                                        href="{{ route('admin.users.index') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.user.list') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            @can('ticket-index')
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.tickets.index','admin.tickets.create','admin.tickets.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z"
                                fill="#000000" opacity="0.3"
                                transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) "/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.ticket.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            {{--<li class="kt-menu__item {{ active_sidebar('admin.tickets.create') }}" aria-haspopup="true"><a
                                    href="{{ route('admin.tickets.create') }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.ticket.add') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>--}}
                            <li class="kt-menu__item {{ active_sidebar('admin.tickets.index') }}" aria-haspopup="true">
                                <a
                                    href="{{ route('admin.tickets.index') }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.ticket.list') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('lottery-index')
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.lotteries.index','admin.lotteries.create','admin.lotteries.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z"
                                fill="#000000" opacity="0.3"/>
                            <path
                                d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z"
                                fill="#000000"/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.lottery.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{ active_sidebar('admin.lotteries.index') }}"
                                aria-haspopup="true"><a
                                    href="{{ route('admin.lotteries.index') }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.lottery.list') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>
                        </ul>
                    </div>
                </li>
            @endcan
            @canany(['group-index','group-create'])
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.groups.index','admin.groups.create','admin.groups.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path
                                d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.group.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('group-create')
                                <li class="kt-menu__item {{ active_sidebar('admin.groups.create') }}"
                                    aria-haspopup="true">
                                    <a
                                        href="{{ route('admin.groups.create') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.group.add') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                            @can('group-index')
                                <li class="kt-menu__item {{ active_sidebar('admin.groups.index') }}"
                                    aria-haspopup="true"><a
                                        href="{{ route('admin.groups.index') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.group.list') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            @canany(['game-index','game-create'])
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.games.index','admin.games.create','admin.games.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M12.9486833,9.31622777 L11.0513167,8.68377223 C11.8160243,6.38964935 13.0426772,4.95855428 14.7574644,4.5298575 C15.650287,4.30665184 17,2.86951059 17,2 L19,2 C19,3.79715607 17.0163797,6.02668149 15.2425356,6.4701425 C14.2906561,6.70811238 13.517309,7.61035065 12.9486833,9.31622777 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path
                                d="M7.05661608,8.02781729 C7.20182559,8.00946022 7.34980802,8 7.5,8 L16.5,8 C16.650192,8 16.7981744,8.00946022 16.9433839,8.02781729 C17.1264244,8.00942131 17.312112,8 17.5,8 C20.5375661,8 23,10.4624339 23,13.5 C23,16.5375661 20.5375661,19 17.5,19 C15.7920631,19 14.2659538,18.2215033 13.2571621,17 L10.7428379,17 C9.73404624,18.2215033 8.20793694,19 6.5,19 C3.46243388,19 1,16.5375661 1,13.5 C1,10.4624339 3.46243388,8 6.5,8 C6.68788804,8 6.87357561,8.00942131 7.05661608,8.02781729 Z M5.5,10 C5.22385763,10 5,10.2238576 5,10.5 L5,11.5 C5,11.7761424 5.22385763,12 5.5,12 L6.5,12 C6.77614237,12 7,11.7761424 7,11.5 L7,10.5 C7,10.2238576 6.77614237,10 6.5,10 L5.5,10 Z M7.5,12 C7.22385763,12 7,12.2238576 7,12.5 L7,13.5 C7,13.7761424 7.22385763,14 7.5,14 L8.5,14 C8.77614237,14 9,13.7761424 9,13.5 L9,12.5 C9,12.2238576 8.77614237,12 8.5,12 L7.5,12 Z M19,12 C19.5522847,12 20,11.5522847 20,11 C20,10.4477153 19.5522847,10 19,10 C18.4477153,10 18,10.4477153 18,11 C18,11.5522847 18.4477153,12 19,12 Z M18,15 C18.5522847,15 19,14.5522847 19,14 C19,13.4477153 18.5522847,13 18,13 C17.4477153,13 17,13.4477153 17,14 C17,14.5522847 17.4477153,15 18,15 Z M5.5,14 C5.22385763,14 5,14.2238576 5,14.5 L5,15.5 C5,15.7761424 5.22385763,16 5.5,16 L6.5,16 C6.77614237,16 7,15.7761424 7,15.5 L7,14.5 C7,14.2238576 6.77614237,14 6.5,14 L5.5,14 Z M3.5,12 C3.22385763,12 3,12.2238576 3,12.5 L3,13.5 C3,13.7761424 3.22385763,14 3.5,14 L4.5,14 C4.77614237,14 5,13.7761424 5,13.5 L5,12.5 C5,12.2238576 4.77614237,12 4.5,12 L3.5,12 Z"
                                fill="#000000"/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.game.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('game-create')
                                <li class="kt-menu__item {{ active_sidebar('admin.games.create') }}"
                                    aria-haspopup="true"><a
                                        href="{{ route('admin.games.create') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.game.add') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                            @can('game-index')
                                <li class="kt-menu__item {{ active_sidebar('admin.games.index') }}"
                                    aria-haspopup="true"><a
                                        href="{{ route('admin.games.index') }}"
                                        class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ __('label.game.list') }}</span><span
                                            class="kt-menu__link-badge"></span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            {{--<li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.pages.index','admin.pages.create','admin.pages.edit'],[],true) }}"
                aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
    </g>
</svg>
                    </span><span class="kt-menu__link-text">{{ __('label.page.text') }}</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ active_sidebar('admin.pages.create') }}"
                            aria-haspopup="true"><a
                                href="{{ route('admin.pages.create') }}"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                    class="kt-menu__link-text">{{ __('label.page.add') }}</span><span
                                    class="kt-menu__link-badge"></span></a></li>
                        <li class="kt-menu__item {{ active_sidebar('admin.pages.index') }}"
                            aria-haspopup="true"><a
                                href="{{ route('admin.pages.index') }}"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                    class="kt-menu__link-text">{{ __('label.page.list') }}</span><span
                                    class="kt-menu__link-badge"></span></a></li>
                    </ul>
                </div>
            </li>--}}
            @can('contact-index')
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar(['admin.contacts.index','admin.contacts.edit'],[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
            fill="#000000"/>
    </g>
</svg>
                    </span><span class="kt-menu__link-text">{{ __('label.contact.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{ active_sidebar('admin.contacts.index') }}"
                                aria-haspopup="true"><a
                                    href="{{ route('admin.contacts.index') }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.contact.list') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('request-index')
                <li class="kt-menu__item  {{ active_sidebar(['admin.requests.index','admin.requests.edit']) }}"
                    aria-haspopup="true"><a
                        href="{{ route('admin.requests.index') }}"
                        class="kt-menu__link "><span
                            class="kt-menu__link-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
     viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
            fill="#000000" opacity="0.3"
            transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
        <path
            d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
            fill="#000000"/>
    </g>
</svg></span><span
                            class="kt-menu__link-text">{{ __('label.request_withdraw.text') }}</span></a></li>
            @endcan
            @can('metabox-index')
                <li class="kt-menu__item  {{ active_sidebar('admin.metabox.index') }}" aria-haspopup="true"><a
                        href="{{ route('admin.metabox.index') }}"
                        class="kt-menu__link "><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M19,11 L20,11 C21.6568542,11 23,12.3431458 23,14 C23,15.6568542 21.6568542,17 20,17 L19,17 L19,20 C19,21.1045695 18.1045695,22 17,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,17 L5,17 C6.65685425,17 8,15.6568542 8,14 C8,12.3431458 6.65685425,11 5,11 L3,11 L3,8 C3,6.8954305 3.8954305,6 5,6 L8,6 L8,5 C8,3.34314575 9.34314575,2 11,2 C12.6568542,2 14,3.34314575 14,5 L14,6 L17,6 C18.1045695,6 19,6.8954305 19,8 L19,11 Z"
            fill="#000000" opacity="0.3"/>
    </g>
</svg></span><span
                            class="kt-menu__link-text">{{ __('label.metabox.text') }}</span></a></li>
            @endcan
            @can('mail-index')
                <li class="kt-menu__item  {{ active_sidebar('admin.mail.index') }}" aria-haspopup="true"><a
                        href="{{ route('admin.mail.index') }}"
                        class="kt-menu__link "><span
                            class="kt-menu__link-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
     viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
            fill="#000000"/>
    </g>
</svg></span><span
                            class="kt-menu__link-text">{{ __('label.mail') }}</span></a></li>
            @endcan
            @can('faq-index')
                <li class="kt-menu__item  {{ active_sidebar('admin.faqs.index') }}" aria-haspopup="true"><a
                        href="{{ route('admin.faqs.index') }}"
                        class="kt-menu__link "><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path
            d="M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z"
            fill="#000000"/>
    </g>
</svg></span><span
                            class="kt-menu__link-text">{{ __('label.faq.text') }}</span></a></li>
            @endcan
            @can('setting-index')
                <li class="kt-menu__item  kt-menu__item--submenu {{ active_sidebar('admin.settings.index',[],true) }}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z"
                                fill="#000000"/>
                            <path
                                d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z"
                                fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    </span><span class="kt-menu__link-text">{{ __('label.setting.text') }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{ active_sidebar('admin.settings.index',['tab' => 'general']) }}"
                                aria-haspopup="true"><a
                                    href="{{ route('admin.settings.index',['tab' => 'general']) }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.general') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>
                            <li class="kt-menu__item {{ active_sidebar('admin.settings.index',['tab' => 'game']) }}"
                                aria-haspopup="true"><a
                                    href="{{ route('admin.settings.index',['tab' => 'game']) }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.game.text') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>
                            {{--<li class="kt-menu__item {{ active_sidebar('admin.settings.index',['tab' => 'reading']) }}"
                                aria-haspopup="true"><a
                                    href="{{ route('admin.settings.index',['tab' => 'reading']) }}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">{{ __('label.reading') }}</span><span
                                        class="kt-menu__link-badge"></span></a></li>--}}
                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>
</div>
