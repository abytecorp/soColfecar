<?php

namespace soColfecar\Http\Controllers;
use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateChapterRequest;
use soColfecar\Http\Requests\UpdateChapterRequest;
use soColfecar\Chapter;
use soColfecar\Chapter_type;
use Auth;

class ChapterController extends Controller
{
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateChapterRequest $request)
    {
 
        $exploded = explode(',', $request->banner);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        $fileName = str_random().'.'.$extension;
        $path = public_path().'/storage/banner/'.$fileName;
        file_put_contents($path, $decoded);
        $logo = $request->file['banner'];
        $chapter = Chapter::create([
            'chapter' => strtoupper($request['chapter']),
            'description' => $request['description'],
            'id_chapter_type' => 1,
            'is_billing' => $request['is_billing'],
            'date_init' => $request['date_init'],
            'date_end' => $request['date_end'],
            'banner' => $fileName,
            'user_id' => Auth::user()->id,
        ]);
        Change::create([
            'description' => 'Ha creado el capitulo: ['.$request['chapter'].'] correctamente.',
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function getChapters()
    {
        $chapters = Chapter::select('chapters.id','chapters.chapter','chapters.description','chapters.id_chapter_type','chapters.is_billing','chapters.date_init',
                                    'chapters.date_end','chapters.banner','chapters.id_status','chapters.user_id','chapters.created_at','status.status')
                    ->orderBy('created_at', 'DESC')
                    //->where('id_status',1)
                    ->join('status','chapters.id_status','status.id')
                    ->get();
        return $chapters;
    }
    public function getChapterTypes()
    {
        $chapter_types = Chapter_type::select('chapter_types.id','chapter_types.chapter_type','chapter_types.id_status','chapter_types.chapter_type AS label')
            ->where('chapter_types.id_status',1)
            ->get();
        return $chapter_types;
    }
    public function getChapter($response)
    {
        return $chapter = Chapter::select('chapters.id AS chapter_id','chapters.chapter','chapters.description','chapters.id_chapter_type','chapters.is_billing','chapters.date_init',
            'chapters.date_end','chapters.banner','chapters.id_status','chapters.user_id','chapters.created_at','chapter_types.chapter_type')
            ->where('chapters.id',$response)
            ->join('chapter_types','chapters.id_chapter_type','chapter_types.id')
            ->first();
    }
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {   
        if($request['bannerChanged']){
        $exploded = explode(',', $request->banner);
                $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        $fileName = str_random().'.'.$extension;
        $path = public_path().'/storage/banner/'.$fileName;
        file_put_contents($path, $decoded);
        $logo = $request->file['banner'];
        $request['banner'] = $fileName;
        }
        $request['chapter'] = strtoupper($request['chapter']);
        $chapter->update(
            $request->all()
        );
        Change::create([
            'description' => 'Actualizo datos del asistente :'.$request['names'].' '.$request['last_names'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    
}
