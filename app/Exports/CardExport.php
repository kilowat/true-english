<?php

namespace App\Exports;

use App\Models\Word;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CardExport implements FromQuery, WithEvents, WithMapping
{
    use RegistersEventListeners;

    private $whereIn;
    private $count = 0;
    private $card_id;

    public function __construct(array $whereIn = [], $id)
    {
        $this->card_id = $id;
        $this->where = $whereIn;
    }

    public function query()
    {
        $query = Word::query()->whereIn('name',$this->where)
            ->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word')
        ->where('card_id', '=', $this->card_id);
        $this->count = $query->count();
  
        return $query;
    }

    public static function beforeExport(BeforeExport $event)
    {
        //
    }

    public static function beforeWriting(BeforeWriting $event)
    {
        //
    }

    public static function beforeSheet(BeforeSheet $event)
    {
        //
    }

    public static function afterSheet(AfterSheet $event)
    {
        foreach ($event->sheet->getColumnIterator() as $row) {

            foreach ($row->getCellIterator() as $cell) {
                if (preg_match('#://#', $cell->getValue()) || preg_match('#audio/#', $cell->getValue())){
                    $cell->setHyperlink(new Hyperlink($cell->getValue(), 'Read'));

                    $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],
                            'underline' => 'single'
                        ]
                    ]);
                }

                //dd(get_class_methods($cell));
                $event->sheet->getStyle($cell->getCoordinate())
                    ->getBorders()
                    ->getAllBorders()
                    ->applyFromArray( [ 'borderStyle' => Border::BORDER_THIN, 'color' => [ 'rgb' => '808080' ] ] );

                $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                    'font' => [
                        'size' => '14'
                    ]
                ]);

                $event->sheet->getStyle($cell->getCoordinate())->getAlignment()->setWrapText(true);

                $event->sheet->getStyle($cell->getCoordinate())->getAlignment()->applyFromArray([
                    'vertical' => "top"
                ]);

                $event->sheet->getDelegate()->getColumnDimension("A")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("B")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("C")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("D")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("E")->setWidth(80);
                $event->sheet->getDelegate()->getColumnDimension("F")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("G")->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension("H")->setAutoSize(true);
            }
        }
    }

    public function map($word): array
    {
        return [
            $word->id,
            $word->freq,
            $word->name,
            $word->transcription,
            $word->translate,
            $word->youglishLink,
            $word->wordHuntLink,
            $word->yandexLink,
            $word->meriamlLinkAttribute,
        ];
    }
    /*
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach ($event->sheet->getColumnIterator('D') as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        if (str_contains($cell->getValue(), '://')) {
                            $cell->setHyperlink(new Hyperlink($cell->getValue(), 'Read'));


                            $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                                'font' => [
                                    'color' => ['rgb' => '0000FF'],
                                    'underline' => 'single'
                                ]
                            ]);
                        }
                    }
                }
            },
        ];
    }
    */
}
