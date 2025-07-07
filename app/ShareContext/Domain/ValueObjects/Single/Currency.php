<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

class Currency
{
    public const AED = 'AED';
    public const AFN = 'AFN';
    public const ALL = 'ALL';
    public const AMD = 'AMD';
    public const ANG = 'ANG';
    public const AOA = 'AOA';
    public const ARS = 'ARS';
    public const AUD = 'AUD';
    public const AWG = 'AWG';
    public const AZN = 'AZN';
    public const BAM = 'BAM';
    public const BBD = 'BBD';
    public const BDT = 'BDT';
    public const BGN = 'BGN';
    public const BHD = 'BHD';
    public const BIF = 'BIF';
    public const BMD = 'BMD';
    public const BND = 'BND';
    public const BOB = 'BOB';
    public const BOV = 'BOV';
    public const BRL = 'BRL';
    public const BSD = 'BSD';
    public const BTN = 'BTN';
    public const BWP = 'BWP';
    public const BYN = 'BYN';
    public const BZD = 'BZD';
    public const CAD = 'CAD';
    public const CDF = 'CDF';
    public const CHE = 'CHE';
    public const CHF = 'CHF';
    public const CHW = 'CHW';
    public const CLF = 'CLF';
    public const CLP = 'CLP';
    public const CNY = 'CNY';
    public const COP = 'COP';
    public const COU = 'COU';
    public const CRC = 'CRC';
    public const CUC = 'CUC';
    public const CUP = 'CUP';
    public const CVE = 'CVE';
    public const CZK = 'CZK';
    public const DJF = 'DJF';
    public const DKK = 'DKK';
    public const DOP = 'DOP';
    public const DZD = 'DZD';
    public const EGP = 'EGP';
    public const ERN = 'ERN';
    public const ETB = 'ETB';
    public const EUR = 'EUR';
    public const FJD = 'FJD';
    public const FKP = 'FKP';
    public const GBP = 'GBP';
    public const GEL = 'GEL';
    public const GHS = 'GHS';
    public const GIP = 'GIP';
    public const GMD = 'GMD';
    public const GNF = 'GNF';
    public const GTQ = 'GTQ';
    public const GYD = 'GYD';
    public const HKD = 'HKD';
    public const HNL = 'HNL';
    public const HRK = 'HRK';
    public const HTG = 'HTG';
    public const HUF = 'HUF';
    public const IDR = 'IDR';
    public const ILS = 'ILS';
    public const INR = 'INR';
    public const IQD = 'IQD';
    public const IRR = 'IRR';
    public const ISK = 'ISK';
    public const JMD = 'JMD';
    public const JOD = 'JOD';
    public const JPY = 'JPY';
    public const KES = 'KES';
    public const KGS = 'KGS';
    public const KHR = 'KHR';
    public const KMF = 'KMF';
    public const KPW = 'KPW';
    public const KRW = 'KRW';
    public const KWD = 'KWD';
    public const KYD = 'KYD';
    public const KZT = 'KZT';
    public const LAK = 'LAK';
    public const LBP = 'LBP';
    public const LKR = 'LKR';
    public const LRD = 'LRD';
    public const LSL = 'LSL';
    public const LYD = 'LYD';
    public const MAD = 'MAD';
    public const MDL = 'MDL';
    public const MGA = 'MGA';
    public const MKD = 'MKD';
    public const MMK = 'MMK';
    public const MNT = 'MNT';
    public const MOP = 'MOP';
    public const MRU = 'MRU';
    public const MUR = 'MUR';
    public const MVR = 'MVR';
    public const MWK = 'MWK';
    public const MXN = 'MXN';
    public const MXV = 'MXV';
    public const MYR = 'MYR';
    public const MZN = 'MZN';
    public const NAD = 'NAD';
    public const NGN = 'NGN';
    public const NIO = 'NIO';
    public const NOK = 'NOK';
    public const NPR = 'NPR';
    public const NZD = 'NZD';
    public const OMR = 'OMR';
    public const PAB = 'PAB';
    public const PEN = 'PEN';
    public const PGK = 'PGK';
    public const PHP = 'PHP';
    public const PKR = 'PKR';
    public const PLN = 'PLN';
    public const PYG = 'PYG';
    public const QAR = 'QAR';
    public const RON = 'RON';
    public const RSD = 'RSD';
    public const RUB = 'RUB';
    public const RWF = 'RWF';
    public const SAR = 'SAR';
    public const SBD = 'SBD';
    public const SCR = 'SCR';
    public const SDG = 'SDG';
    public const SEK = 'SEK';
    public const SGD = 'SGD';
    public const SHP = 'SHP';
    public const SLL = 'SLL';
    public const SOS = 'SOS';
    public const SRD = 'SRD';
    public const SSP = 'SSP';
    public const STN = 'STN';
    public const SVC = 'SVC';
    public const SYP = 'SYP';
    public const SZL = 'SZL';
    public const THB = 'THB';
    public const TJS = 'TJS';
    public const TMT = 'TMT';
    public const TND = 'TND';
    public const TOP = 'TOP';
    public const TRY = 'TRY';
    public const TTD = 'TTD';
    public const TWD = 'TWD';
    public const TZS = 'TZS';
    public const UAH = 'UAH';
    public const UGX = 'UGX';
    public const USD = 'USD';
    public const USN = 'USN';
    public const UYI = 'UYI';
    public const UYU = 'UYU';
    public const UYW = 'UYW';
    public const UZS = 'UZS';
    public const VES = 'VES';
    public const VND = 'VND';
    public const VUV = 'VUV';
    public const WST = 'WST';
    public const XAF = 'XAF';
    public const XCD = 'XCD';
    public const XOF = 'XOF';
    public const XPF = 'XPF';
    public const YER = 'YER';
    public const ZAR = 'ZAR';
    public const ZMW = 'ZMW';
    public const ZWL = 'ZWL';

    public const CONFIG = [
        'AED' => ['iso' => 784, 'decimals' => 2],
        'AFN' => ['iso' => 971, 'decimals' => 2],
        'ALL' => ['iso' => 8, 'decimals' => 2],
        'AMD' => ['iso' => 51, 'decimals' => 2],
        'ANG' => ['iso' => 532, 'decimals' => 2],
        'AOA' => ['iso' => 973, 'decimals' => 2],
        'ARS' => ['iso' => 32, 'decimals' => 3],
        'AUD' => ['iso' => 36, 'decimals' => 2],
        'AWG' => ['iso' => 533, 'decimals' => 2],
        'AZN' => ['iso' => 944, 'decimals' => 2],
        'BAM' => ['iso' => 977, 'decimals' => 2],
        'BBD' => ['iso' => 52, 'decimals' => 2],
        'BDT' => ['iso' => 50, 'decimals' => 2],
        'BGN' => ['iso' => 975, 'decimals' => 2],
        'BHD' => ['iso' => 48, 'decimals' => 3],
        'BIF' => ['iso' => 108, 'decimals' => 0],
        'BMD' => ['iso' => 60, 'decimals' => 2],
        'BND' => ['iso' => 96, 'decimals' => 2],
        'BOB' => ['iso' => 68, 'decimals' => 2],
        'BOV' => ['iso' => 984, 'decimals' => 2],
        'BRL' => ['iso' => 986, 'decimals' => 2],
        'BSD' => ['iso' => 44, 'decimals' => 2],
        'BTN' => ['iso' => 64, 'decimals' => 2],
        'BWP' => ['iso' => 72, 'decimals' => 2],
        'BYN' => ['iso' => 933, 'decimals' => 2],
        'BZD' => ['iso' => 84, 'decimals' => 2],
        'CAD' => ['iso' => 124, 'decimals' => 2],
        'CDF' => ['iso' => 976, 'decimals' => 2],
        'CHE' => ['iso' => 947, 'decimals' => 2],
        'CHF' => ['iso' => 756, 'decimals' => 2],
        'CHW' => ['iso' => 948, 'decimals' => 2],
        'CLF' => ['iso' => 990, 'decimals' => 4],
        'CLP' => ['iso' => 152, 'decimals' => 0],
        'CNY' => ['iso' => 156, 'decimals' => 2],
        'COP' => ['iso' => 170, 'decimals' => 2],
        'COU' => ['iso' => 970, 'decimals' => 2],
        'CRC' => ['iso' => 188, 'decimals' => 2],
        'CUC' => ['iso' => 931, 'decimals' => 2],
        'CUP' => ['iso' => 192, 'decimals' => 2],
        'CVE' => ['iso' => 132, 'decimals' => 2],
        'CZK' => ['iso' => 203, 'decimals' => 2],
        'DJF' => ['iso' => 262, 'decimals' => 0],
        'DKK' => ['iso' => 208, 'decimals' => 2],
        'DOP' => ['iso' => 214, 'decimals' => 2],
        'DZD' => ['iso' => 12, 'decimals' => 2],
        'EGP' => ['iso' => 818, 'decimals' => 2],
        'ERN' => ['iso' => 232, 'decimals' => 2],
        'ETB' => ['iso' => 230, 'decimals' => 2],
        'EUR' => ['iso' => 978, 'decimals' => 2],
        'FJD' => ['iso' => 242, 'decimals' => 2],
        'FKP' => ['iso' => 238, 'decimals' => 2],
        'GBP' => ['iso' => 826, 'decimals' => 2],
        'GEL' => ['iso' => 981, 'decimals' => 2],
        'GHS' => ['iso' => 936, 'decimals' => 2],
        'GIP' => ['iso' => 292, 'decimals' => 2],
        'GMD' => ['iso' => 270, 'decimals' => 2],
        'GNF' => ['iso' => 324, 'decimals' => 0],
        'GTQ' => ['iso' => 320, 'decimals' => 2],
        'GYD' => ['iso' => 328, 'decimals' => 2],
        'HKD' => ['iso' => 344, 'decimals' => 2],
        'HNL' => ['iso' => 340, 'decimals' => 2],
        'HRK' => ['iso' => 191, 'decimals' => 2],
        'HTG' => ['iso' => 332, 'decimals' => 2],
        'HUF' => ['iso' => 348, 'decimals' => 2],
        'IDR' => ['iso' => 360, 'decimals' => 2],
        'ILS' => ['iso' => 376, 'decimals' => 2],
        'INR' => ['iso' => 356, 'decimals' => 2],
        'IQD' => ['iso' => 368, 'decimals' => 3],
        'IRR' => ['iso' => 364, 'decimals' => 2],
        'ISK' => ['iso' => 352, 'decimals' => 0],
        'JMD' => ['iso' => 388, 'decimals' => 2],
        'JOD' => ['iso' => 400, 'decimals' => 3],
        'JPY' => ['iso' => 392, 'decimals' => 0],
        'KES' => ['iso' => 404, 'decimals' => 2],
        'KGS' => ['iso' => 417, 'decimals' => 2],
        'KHR' => ['iso' => 116, 'decimals' => 2],
        'KMF' => ['iso' => 174, 'decimals' => 0],
        'KPW' => ['iso' => 408, 'decimals' => 2],
        'KRW' => ['iso' => 410, 'decimals' => 0],
        'KWD' => ['iso' => 414, 'decimals' => 3],
        'KYD' => ['iso' => 136, 'decimals' => 2],
        'KZT' => ['iso' => 398, 'decimals' => 2],
        'LAK' => ['iso' => 418, 'decimals' => 2],
        'LBP' => ['iso' => 422, 'decimals' => 2],
        'LKR' => ['iso' => 144, 'decimals' => 2],
        'LRD' => ['iso' => 430, 'decimals' => 2],
        'LSL' => ['iso' => 426, 'decimals' => 2],
        'LYD' => ['iso' => 434, 'decimals' => 3],
        'MAD' => ['iso' => 504, 'decimals' => 2],
        'MDL' => ['iso' => 498, 'decimals' => 2],
        'MGA' => ['iso' => 969, 'decimals' => 2],
        'MKD' => ['iso' => 807, 'decimals' => 2],
        'MMK' => ['iso' => 104, 'decimals' => 2],
        'MNT' => ['iso' => 496, 'decimals' => 2],
        'MOP' => ['iso' => 446, 'decimals' => 2],
        'MRU' => ['iso' => 929, 'decimals' => 2],
        'MUR' => ['iso' => 480, 'decimals' => 2],
        'MVR' => ['iso' => 462, 'decimals' => 2],
        'MWK' => ['iso' => 454, 'decimals' => 2],
        'MXN' => ['iso' => 484, 'decimals' => 2],
        'MXV' => ['iso' => 979, 'decimals' => 2],
        'MYR' => ['iso' => 458, 'decimals' => 2],
        'MZN' => ['iso' => 943, 'decimals' => 2],
        'NAD' => ['iso' => 516, 'decimals' => 2],
        'NGN' => ['iso' => 566, 'decimals' => 2],
        'NIO' => ['iso' => 558, 'decimals' => 2],
        'NOK' => ['iso' => 578, 'decimals' => 2],
        'NPR' => ['iso' => 524, 'decimals' => 2],
        'NZD' => ['iso' => 554, 'decimals' => 2],
        'OMR' => ['iso' => 512, 'decimals' => 3],
        'PAB' => ['iso' => 590, 'decimals' => 2],
        'PEN' => ['iso' => 604, 'decimals' => 2],
        'PGK' => ['iso' => 598, 'decimals' => 2],
        'PHP' => ['iso' => 608, 'decimals' => 2],
        'PKR' => ['iso' => 586, 'decimals' => 2],
        'PLN' => ['iso' => 985, 'decimals' => 2],
        'PYG' => ['iso' => 600, 'decimals' => 0],
        'QAR' => ['iso' => 634, 'decimals' => 2],
        'RON' => ['iso' => 946, 'decimals' => 2],
        'RSD' => ['iso' => 941, 'decimals' => 2],
        'RUB' => ['iso' => 643, 'decimals' => 2],
        'RWF' => ['iso' => 646, 'decimals' => 0],
        'SAR' => ['iso' => 682, 'decimals' => 2],
        'SBD' => ['iso' => 90, 'decimals' => 2],
        'SCR' => ['iso' => 690, 'decimals' => 2],
        'SDG' => ['iso' => 938, 'decimals' => 2],
        'SEK' => ['iso' => 752, 'decimals' => 2],
        'SGD' => ['iso' => 702, 'decimals' => 2],
        'SHP' => ['iso' => 654, 'decimals' => 2],
        'SLL' => ['iso' => 694, 'decimals' => 2],
        'SOS' => ['iso' => 706, 'decimals' => 2],
        'SRD' => ['iso' => 968, 'decimals' => 2],
        'SSP' => ['iso' => 728, 'decimals' => 2],
        'STN' => ['iso' => 930, 'decimals' => 2],
        'SVC' => ['iso' => 222, 'decimals' => 2],
        'SYP' => ['iso' => 760, 'decimals' => 2],
        'SZL' => ['iso' => 748, 'decimals' => 2],
        'THB' => ['iso' => 764, 'decimals' => 2],
        'TJS' => ['iso' => 972, 'decimals' => 2],
        'TMT' => ['iso' => 934, 'decimals' => 2],
        'TND' => ['iso' => 788, 'decimals' => 3],
        'TOP' => ['iso' => 776, 'decimals' => 2],
        'TRY' => ['iso' => 949, 'decimals' => 2],
        'TTD' => ['iso' => 780, 'decimals' => 2],
        'TWD' => ['iso' => 901, 'decimals' => 2],
        'TZS' => ['iso' => 834, 'decimals' => 2],
        'UAH' => ['iso' => 980, 'decimals' => 2],
        'UGX' => ['iso' => 800, 'decimals' => 0],
        'USD' => ['iso' => 840, 'decimals' => 2],
        'USN' => ['iso' => 997, 'decimals' => 2],
        'UYI' => ['iso' => 940, 'decimals' => 0],
        'UYU' => ['iso' => 858, 'decimals' => 2],
        'UYW' => ['iso' => 927, 'decimals' => 4],
        'UZS' => ['iso' => 860, 'decimals' => 2],
        'VES' => ['iso' => 928, 'decimals' => 2],
        'VND' => ['iso' => 704, 'decimals' => 0],
        'VUV' => ['iso' => 548, 'decimals' => 0],
        'WST' => ['iso' => 882, 'decimals' => 2],
        'XAF' => ['iso' => 950, 'decimals' => 0],
        'XCD' => ['iso' => 951, 'decimals' => 2],
        'XOF' => ['iso' => 952, 'decimals' => 0],
        'XPF' => ['iso' => 953, 'decimals' => 0],
        'YER' => ['iso' => 886, 'decimals' => 2],
        'ZAR' => ['iso' => 710, 'decimals' => 2],
        'ZMW' => ['iso' => 967, 'decimals' => 2],
        'ZWL' => ['iso' => 932, 'decimals' => 2],
    ];

    public const ALLOWED_CURRENCIES = [
        self::AED,
        self::AFN,
        self::ALL,
        self::AMD,
        self::ANG,
        self::AOA,
        self::ARS,
        self::AUD,
        self::AWG,
        self::AZN,
        self::BAM,
        self::BBD,
        self::BDT,
        self::BGN,
        self::BHD,
        self::BIF,
        self::BMD,
        self::BND,
        self::BOB,
        self::BOV,
        self::BRL,
        self::BSD,
        self::BTN,
        self::BWP,
        self::BYN,
        self::BZD,
        self::CAD,
        self::CDF,
        self::CHE,
        self::CHF,
        self::CHW,
        self::CLF,
        self::CLP,
        self::CNY,
        self::COP,
        self::COU,
        self::CRC,
        self::CUC,
        self::CUP,
        self::CVE,
        self::CZK,
        self::DJF,
        self::DKK,
        self::DOP,
        self::DZD,
        self::EGP,
        self::ERN,
        self::ETB,
        self::EUR,
        self::FJD,
        self::FKP,
        self::GBP,
        self::GEL,
        self::GHS,
        self::GIP,
        self::GMD,
        self::GNF,
        self::GTQ,
        self::GYD,
        self::HKD,
        self::HNL,
        self::HRK,
        self::HTG,
        self::HUF,
        self::IDR,
        self::ILS,
        self::INR,
        self::IQD,
        self::IRR,
        self::ISK,
        self::JMD,
        self::JOD,
        self::JPY,
        self::KES,
        self::KGS,
        self::KHR,
        self::KMF,
        self::KPW,
        self::KRW,
        self::KWD,
        self::KYD,
        self::KZT,
        self::LAK,
        self::LBP,
        self::LKR,
        self::LRD,
        self::LSL,
        self::LYD,
        self::MAD,
        self::MDL,
        self::MGA,
        self::MKD,
        self::MMK,
        self::MNT,
        self::MOP,
        self::MRU,
        self::MUR,
        self::MVR,
        self::MWK,
        self::MXN,
        self::MXV,
        self::MYR,
        self::MZN,
        self::NAD,
        self::NGN,
        self::NIO,
        self::NOK,
        self::NPR,
        self::NZD,
        self::OMR,
        self::PAB,
        self::PEN,
        self::PGK,
        self::PHP,
        self::PKR,
        self::PLN,
        self::PYG,
        self::QAR,
        self::RON,
        self::RSD,
        self::RUB,
        self::RWF,
        self::SAR,
        self::SBD,
        self::SCR,
        self::SDG,
        self::SEK,
        self::SGD,
        self::SHP,
        self::SLL,
        self::SOS,
        self::SRD,
        self::SSP,
        self::STN,
        self::SVC,
        self::SYP,
        self::SZL,
        self::THB,
        self::TJS,
        self::TMT,
        self::TND,
        self::TOP,
        self::TRY,
        self::TTD,
        self::TWD,
        self::TZS,
        self::UAH,
        self::UGX,
        self::USD,
        self::USN,
        self::UYI,
        self::UYU,
        self::UYW,
        self::UZS,
        self::VES,
        self::VND,
        self::VUV,
        self::WST,
        self::XAF,
        self::XCD,
        self::XOF,
        self::XPF,
        self::YER,
        self::ZAR,
        self::ZMW,
        self::ZWL,
    ];

    /**
     * @var string
     */
    private $value;

    private function __construct(string $currency)
    {
        $this->checkValueIsAllowed($currency);
        $this->value = $currency;
    }

    public static function fromValue(string $value): Currency
    {
        return new self($value);
    }

    private function checkValueIsAllowed(string $value): void
    {
        if (!in_array($value, self::ALLOWED_CURRENCIES)) {
            throw new InvalidArgumentException("$value is not an allowed currency");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function config(): CurrencyConfig
    {
        return new CurrencyConfig(self::CONFIG[$this->value()]['iso'], self::CONFIG[$this->value()]['decimals']);
    }

    public function equal(Currency $currency): bool
    {
        return $this->value === $currency->value;
    }
}
