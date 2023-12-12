<?php

namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\Models\Source;
use App\Models\UserPreference;


class UserRepository implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function preferences()
    {
        return  UserPreference::where('user_id',auth()->user()->id)->get();
    }

    public function sources()
    {
        $userPreferences = UserPreference::where(['user_id' => auth()->user()->id])->pluck('preference')->toArray();

        $data['authors'] = Source::whereNotIn('author', $userPreferences)
            ->whereNotNull('author')
            ->select('id', 'author')
            ->groupBy('author', 'id')
            ->get()
            ->map(function ($authorItem) {
                return [
                    'id' => $authorItem->id,
                    'author' => $authorItem->author,
                ];
            })
            ->toArray();

        $data['references'] = Source::whereNotIn('reference', $userPreferences)
            ->whereNotNull('reference')
            ->select('id', 'reference')
            ->groupBy('reference', 'id')
            ->get()
            ->map(function ($referenceItem) {
                return [
                    'id' => $referenceItem->id,
                    'reference' => $referenceItem->reference,
                ];
            })
            ->toArray();

        $data['categories'] = Source::whereNotIn('category', $userPreferences)->whereNotNull('category')
            ->select('category')->groupBy('category')->get()->pluck('category')->toArray();

        $data['categories'] = Source::whereNotIn('category', $userPreferences)
            ->whereNotNull('category')
            ->select('id', 'category')
            ->groupBy('category', 'id')
            ->get()
            ->map(function ($referenceItem) {
                return [
                    'id' => $referenceItem->id,
                    'category' => $referenceItem->category,
                ];
            })
            ->toArray();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function addPreferences(string $type,string $preference)
    {
        UserPreference::create([
            'user_id'=>auth()->user()->id,
            'type'=>$type,
            'preference'=>$preference
        ]);

    }

    /**
     * @inheritDoc
     */
    public function deletePreferences($id)
    {
        UserPreference::find($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function news($requests)
    {
        $preferences = auth()->user()->preferences()->get()->pluck('preference')->toArray();

        if (empty($preferences)) {
            return  Source::filter($requests)->paginate(10);
        } else {
            return  Source::filter($requests)->filterByPreferences($preferences)->paginate(10);
        }
    }

}
