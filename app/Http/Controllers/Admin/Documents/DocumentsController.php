<?php

namespace App\Http\Controllers\Admin\Documents;

use App\Models\DocumentCategory;
use Illuminate\Http\UploadedFile;
use Redirect;
use App\Http\Requests;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class DocumentsController extends AdminController
{
    /**
     * Display a listing of document.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $items = Document::with('documentable')->get();

        return $this->view('documents.index')->with('items', $items);
    }

    /**
     * Show the Documentable's photos
     * Create / Edit / Delete the photos
     * @param $documentable
     * @param $documents
     * @return mixed
     */
    private function showDocumentable($documentable, $documents)
    {
        save_resource_url();

        return $this->view('documents.create_edit')
            ->with('documentable', $documentable)
            ->with('documents', $documents);
    }

    /**
     * Show the category's documents
     * @param DocumentCategory $category
     * @return mixed
     */
    public function showCategory(DocumentCategory $category)
    {
        $documents = $category->documents;

        return $this->showDocumentable($category, $documents);
    }

    /**
     * Upload a new photo to the album
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload()
    {
        // upload the photo here
        $attributes = request()->validate(Document::$rules);

        // get the documentable
        $documentable = input('documentable_type')::find(input('documentable_id'));

        if (!$documentable) {
            return json_response_error('Whoops', 'We could not find the documentable.');
        }

        // move and create the photo
        $photo = $this->moveAndCreateDocument($attributes['file'], $documentable);

        if (!$photo) {
            return json_response_error('Whoops', 'Something went wrong, please try again.');
        }

        return json_response(['id' => $photo->id]);
    }

    /**
     * Update the photo's name
     * @param Document $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateName(Document $document)
    {
        $document->update(['name' => input('name')]);

        return json_response();
    }

    /**
     * Remove the specified photo from storage.
     *
     * @param Document $document
     * @return Response
     */
    public function destroy(Document $document)
    {
        $this->deleteEntry($document, request());

        return redirect_to_resource();
    }

    /**
     * Move document to /uploads/documents
     * @param UploadedFile $file
     * @param              $documentable
     * @return \Illuminate\Http\JsonResponse|static
     */
    private function moveAndCreateDocument(UploadedFile $file, $documentable)
    {
        $name = token();
        $extension = '.' . $file->extension();
        $filename = $name . $extension;

        $file->move(upload_path('documents'), $filename);

        // file not moved
        if (!\File::exists(upload_path('documents') . $filename)) {
            return false;
        }

        $originalName = $file->getClientOriginalName();
        $originalName = substr($originalName, 0, strpos($originalName, $extension));
        $name = strlen($originalName) <= 2 ? $documentable->name : $originalName;
        $photo = Document::create([
            'filename'          => $filename,
            'documentable_id'   => $documentable->id,
            'documentable_type' => get_class($documentable),
            'name'              => strlen($name) < 2 ? 'Document Name' : $name,
        ]);

        return $photo;
    }
}
