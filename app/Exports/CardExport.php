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

class CardExport implements FromQuery, WithEvents, WithMapping, ShouldAutoSize
{
    use RegistersEventListeners;

    private $whereIn;

    public function __construct(array $whereIn = [])
    {

        $this->where = $whereIn;
    }

    public function query()
    {
        return Word::query()->whereIn('name',$this->where);
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
                if (preg_match('#://#', $cell->getValue())){
                    $cell->setHyperlink(new Hyperlink($cell->getValue(), 'Read'));

                    $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],
                            'underline' => 'single'
                        ]
                    ]);
                }

                if($cell->getColumn() == "D"){
                    $event->sheet->getStyle($cell->getCoordinate());
                }

                //dd(get_class_methods($cell));
                $event->sheet->getStyle($cell->getCoordinate())
                    ->getBorders()
                    ->getAllBorders()
                    ->applyFromArray( [ 'borderStyle' => Border::BORDER_THIN, 'color' => [ 'rgb' => '808080' ] ] );


                $event->sheet->getStyle($cell->getCoordinate())->getAlignment()->setWrapText(true);



            }
        }
    }

    public function map($word): array
    {
        return [
            $word->id,
            $word->name,
            $word->transcription,
            $word->translate,
            $word->contextReversoLink,
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
