<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourDownloadService;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourDownloadController extends Controller
{
    use ResponseAPI;
    protected $tour_download_service;
    protected $tour_service;

    public function __construct(
        TourDownloadService $tour_download_service,
        TourService $tour_service
    ) {
        $this->tour_download_service = $tour_download_service;
        $this->tour_service = $tour_service;
    }

    public function index($tour_id)
    {
        abort_if(Gate::denies('tour_download_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($tour_id);
        return view('tour_download.index', compact('tour'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('tour_download_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_download_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('tour_download_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rules = [
            'tour_id'    => 'required|exists:tours,id',
            'file_type'  => 'required|string|in:document,image,audio,video',
        ];

        $fileType = $request->input('file_type');

        switch ($fileType) {
            case 'image':
                $rules['file'] = 'required|file|mimes:jpg,jpeg,png,gif,webp|max:20480'; // 20MB
                break;
            case 'document':
                $rules['file'] = 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:51200'; // 50MB
                break;
            case 'audio':
                $rules['file'] = 'required|file|mimes:mp3,wav,aac,ogg|max:51200'; // 50MB
                break;
            case 'video':
                $rules['file'] = 'required|file|mimes:mp4,mov,avi,wmv,flv,mkv|max:102400'; // 100MB
                break;
            default:
                $rules['file'] = 'required|file';
                break;
        }

        $validation = Validator::make($request->all(), $rules, $this->validationMessage());

        if ($validation->fails()) {
            $validation_error = "";
            foreach ($validation->errors()->all() as $message) {
                $validation_error .= $message;
            }
            return $this->validationResponse(
                $validation_error
            );
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('file')) {
                $obj['file_path'] = $request->file('file')->store('tours', 'public');
            }

            $response = $this->tour_download_service->save($obj);

            if (!$response) {
                return $this->error(ResponseMessage::ERROR);
            }

            return  $this->success(
                $response,
                ResponseMessage::SAVE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function destroy($id)
    {
        abort_if(Gate::denies('tour_download_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_download = $this->tour_download_service->deleteById($id);
            return $this->success(
                $tour_download,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
