<div class="col-md-4 col-sm-4 col-xs-4 " style="padding:0;">
                @if(!$corpsearchprofile->contains('profile_id', $user->id))
                <form action="/profile/save" method="post" id="profile-save-{{$user->id}}" data-saveid="{{$user->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="profileid" value="{{ $user->id }}">
                    <button id="profilesave-btn-{{$user->id}}" class="btn blue corp-profile-contact fav-btn profile-save-btn" type="button" style="">           
                        <i class="fa fa-save (alias)" style="font-size: 14px;color:white;"></i> Save Profile
                    </button>
                </form>
                @elseif($corpsearchprofile->contains('profile_id', $user->id)->where('user_id', Auth::user()->corpuser_id)->first()->save_profile == 1)
                <button>Saved</button>
                @else
                <form action="/profile/save" method="post" id="profile-save-{{$user->id}}" data-saveid="{{$user->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="profileid" value="{{ $user->id }}">
                    <button id="profilesave-btn-{{$user->id}}" class="btn blue corp-profile-contact fav-btn profile-save-btn" type="button" style="">           
                        <i class="fa fa-save (alias)" style="font-size: 14px;color:white;"></i> Save Profile
                    </button>
                </form>
                @endif
            </div>



            if($post_type == 'skill'){
            $skillPosts = Postjob::orderBy('postjobs.id', 'desc')
                                 ->with('indUser', 'corpUser', 'postActivity', 'preferLocations')
                                 ->leftjoin('post_preferred_locations', 'post_preferred_locations.post_id', '=', 'postjobs.id')
                                 ->where('postjobs.post_type', '=', 'skill');

        
        if($post_title != null){
            $skillPosts->where('post_title', 'like', '%'.$post_title.'%')
                         ->whereRaw("(job_detail like '%".$post_title."%' or role like '%".$post_title."%' or linked_skill like '%".$post_title."%')");
            }
        if($city != null){
                $p_locality = [];
                $p_city = [];
                foreach ($city as $loc) {
                    $tempArr = explode('-', $loc);
                    if(count($tempArr) == 3){           
                        array_push($p_locality, $tempArr[0]) ;
                        array_push($p_city, $tempArr[1]) ;
                    }
                    if(count($tempArr) == 2){
                        array_push($p_city, $tempArr[0]) ;              
                    }
                }
                $skillPosts->whereIn('post_preferred_locations.city', $p_city);
                $skillPosts->whereIn('post_preferred_locations.locality', $p_locality);
            }
        if($time_for != null){
            $skillPosts->whereIn('time_for', $time_for);
            // return $time_for;
        }
        if($experience != null){
            $skillPosts->whereRaw("min_exp between $experience and $experience_new");
        }

        if($skill != null){
                foreach ($skill as $skil) {
                    $jobPosts->where('linked_skill', 'like', '%'.$skil.'%');
                }
            }

        $skillPosts = $skillPosts->paginate(15);
        }

        if($save_filter == 'savefilter'){
            return view('pages.home', compact('jobPosts', 'skillPosts', 'linksApproval', 'linksPending', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill', 'filter', 'skillfilter'))->withErrors([
                'errors' => 'Filter Save successfully.',
            ]);
        }else{
            return view('pages.home', compact('jobPosts', 'skillPosts', 'linksApproval', 'linksPending', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill', 'filter', 'skillfilter'));
        }   