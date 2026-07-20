/* ============================================
   MR. VIKING - Model Database (v2)
   Contains data for all families and variants
   ============================================ */

const bikeData = {
    // ==========================================
    // MR. VIKING MODELS
    // ==========================================
    "brutale-1000-rr-assen": {
        id: "brutale-1000-rr-assen",
        brand: "MR. VIKING",
        family: "BRUTALE",
        name: "Brutale 1000 RR Assen",
        description: "Limited Edition - Only 300 numbered units.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR ASSEN.webp",
        priceBDT: "9,500,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "brutale-1000-rr": {
        id: "brutale-1000-rr",
        brand: "MR. VIKING",
        family: "BRUTALE",
        name: "Brutale 1000 RR",
        description: "The hyper-naked benchmark.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR.webp",
        priceBDT: "8,800,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "brutale-1000-rs": {
        id: "brutale-1000-rs",
        brand: "MR. VIKING",
        family: "BRUTALE",
        name: "Brutale 1000 RS",
        description: "Evolved performance for the road.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RS.webp",
        priceBDT: "7,500,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "brutale-800": {
        id: "brutale-800",
        brand: "MR. VIKING",
        family: "BRUTALE",
        name: "Brutale 800",
        description: "The three-cylinder icon.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 800.webp",
        priceBDT: "4,500,000",
        stats: { cylinders: "3", capacity: "798", hp: "140" }
    },
    "brutale-rr-80": {
        id: "brutale-rr-80",
        brand: "MR. VIKING",
        family: "BRUTALE",
        name: "Brutale RR Ottantesimo",
        description: "Celebrating 80 years of MR. VIKING.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE RR OTTANTESIMO.webp",
        priceBDT: "5,200,000",
        stats: { cylinders: "3", capacity: "798", hp: "140" }
    },
    "dragster-rr-80": {
        id: "dragster-rr-80",
        brand: "MR. VIKING",
        family: "DRAGSTER",
        name: "Dragster RR Ottantesimo",
        description: "Pure rebellious spirit.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/DRAGSTER RR OTTANTESIMO.webp",
        priceBDT: "5,500,000",
        stats: { cylinders: "3", capacity: "798", hp: "140" }
    },
    "enduro-veloce": {
        id: "enduro-veloce",
        brand: "MR. VIKING",
        family: "ENDURO VELOCE",
        name: "Enduro Veloce",
        description: "Adventure without limits.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE ENDURO VELOCE.webp",
        priceBDT: "6,200,000",
        stats: { cylinders: "3", capacity: "931", hp: "124" }
    },
    "enduro-veloce-lxp": {
        id: "enduro-veloce-lxp",
        brand: "MR. VIKING",
        family: "ENDURO VELOCE",
        name: "Enduro Veloce LXP Orioli",
        description: "Ultimate off-road exploration.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE  LXP ORIOLI.png",
        priceBDT: "7,000,000",
        stats: { cylinders: "3", capacity: "931", hp: "124" }
    },
    "f3-competizione": {
        id: "f3-competizione",
        brand: "MR. VIKING",
        family: "F3",
        name: "F3 Competizione",
        description: "Racing DNA at its finest.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 COMPETIZIONE.webp",
        priceBDT: "8,200,000",
        stats: { cylinders: "3", capacity: "798", hp: "160" }
    },
    "f3-r": {
        id: "f3-r",
        brand: "MR. VIKING",
        family: "F3",
        name: "F3 R",
        description: "The essence of supersport.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 R.png",
        priceBDT: "5,500,000",
        stats: { cylinders: "3", capacity: "798", hp: "147" }
    },
    "f3-rr": {
        id: "f3-rr",
        brand: "MR. VIKING",
        family: "F3",
        name: "F3 RR",
        description: "Aerodynamic perfection.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 RR.webp",
        priceBDT: "6,500,000",
        stats: { cylinders: "3", capacity: "798", hp: "147" }
    },
    "rush-mamba": {
        id: "rush-mamba",
        brand: "MR. VIKING",
        family: "RUSH",
        name: "Rush Mamba",
        description: "The world's most aggressive naked bike.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/RUSH Mamba.webp",
        priceBDT: "12,000,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "superveloce-1000-ago": {
        id: "superveloce-1000-ago",
        brand: "MR. VIKING",
        family: "SUPERVELOCE",
        name: "Superveloce 1000 Ago",
        description: "A tribute to Giacomo Agostini.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 1000 AGO.webp",
        priceBDT: "15,000,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "superveloce-1000-oro": {
        id: "superveloce-1000-oro",
        brand: "MR. VIKING",
        family: "SUPERVELOCE",
        name: "Superveloce 1000 Serie Oro",
        description: "Motorcycle art in gold.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 1000 SERIE ORO.webp",
        priceBDT: "18,000,000",
        stats: { cylinders: "4", capacity: "998", hp: "208" }
    },
    "superveloce-98": {
        id: "superveloce-98",
        brand: "MR. VIKING",
        family: "SUPERVELOCE",
        name: "Superveloce 98 Edition",
        description: "Heritage reimagined.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 98.png",
        priceBDT: "7,000,000",
        stats: { cylinders: "3", capacity: "798", hp: "148" }
    },
    "superveloce-s": {
        id: "superveloce-s",
        brand: "MR. VIKING",
        family: "SUPERVELOCE",
        name: "Superveloce S",
        description: "Classic beauty meets modern tech.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE S.webp",
        priceBDT: "6,800,000",
        stats: { cylinders: "3", capacity: "798", hp: "148" }
    },
    "turismo-veloce-r": {
        id: "turismo-veloce-r",
        brand: "MR. VIKING",
        family: "TURISMO VELOCE",
        name: "Turismo Veloce R",
        description: "Fast touring excellence.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE  R.png",
        priceBDT: "5,800,000",
        stats: { cylinders: "3", capacity: "798", hp: "110" }
    },
    "turismo-veloce-lusso": {
        id: "turismo-veloce-lusso",
        brand: "MR. VIKING",
        family: "TURISMO VELOCE",
        name: "Turismo Veloce Lusso SCS",
        description: "The ultimate road voyager.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE LUSSO SCS.webp",
        priceBDT: "6,500,000",
        stats: { cylinders: "3", capacity: "798", hp: "110" }
    },
    "turismo-veloce-r-scs": {
        id: "turismo-veloce-r-scs",
        brand: "MR. VIKING",
        family: "TURISMO VELOCE",
        name: "Turismo Veloce R SCS",
        description: "Dynamic touring performance.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE R SCS.webp",
        priceBDT: "6,200,000",
        stats: { cylinders: "3", capacity: "798", hp: "110" }
    },

    // ==========================================
    // HONDA MODELS (Bangladesh Market)
    // ==========================================
    "honda-dio": {
        id: "honda-dio",
        brand: "HONDA",
        family: "SCOOTER",
        name: "Honda Dio",
        description: "Smart and sporty urban scooter.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/DIO  Pearl Igneous Black.png",
        priceBDT: "199,000",
        stats: { cylinders: "1", capacity: "110cc", hp: "8.0" }
    },
    "honda-dream": {
        id: "honda-dream",
        brand: "HONDA",
        family: "COMMUTER",
        name: "Honda Dream 110",
        description: "Reliable and fuel-efficient performance.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/Dream 110 Red.png",
        priceBDT: "121,000",
        stats: { cylinders: "1", capacity: "110cc", hp: "8.25" }
    },
    "honda-livo": {
        id: "honda-livo",
        brand: "HONDA",
        family: "COMMUTER",
        name: "Honda Livo CBS",
        description: "Style meets economy.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/Honda Livo CBS Imperial Red Metallic.png",
        priceBDT: "145,000",
        stats: { cylinders: "1", capacity: "110cc", hp: "8.31" }
    },
    "honda-hornet": {
        id: "honda-hornet",
        brand: "HONDA",
        family: "SPORT",
        name: "Honda Hornet 2.0",
        description: "Muscular performance with USD forks.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/Hornet 2.0 Pearl Igneous Black.png",
        priceBDT: "289,000",
        stats: { cylinders: "1", capacity: "184cc", hp: "17.2" }
    },
    "honda-sp125": {
        id: "honda-sp125",
        brand: "HONDA",
        family: "COMMUTER",
        name: "Honda SP 125",
        description: "The advanced commuter.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SP 125 Matt Marvel Blue.png",
        priceBDT: "167,000",
        stats: { cylinders: "1", capacity: "125cc", hp: "10.8" }
    },
    "honda-sp160": {
        id: "honda-sp160",
        brand: "HONDA",
        family: "SPORT",
        name: "Honda SP 160",
        description: "Comfortable sport riding.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/SP160 Pearl igneous Black.png",
        priceBDT: "225,000",
        stats: { cylinders: "1", capacity: "160cc", hp: "13.5" }
    },
    "honda-shine": {
        id: "honda-shine",
        brand: "HONDA",
        family: "COMMUTER",
        name: "Honda Shine 100",
        description: "Basic commuting at its best.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/Shine 100 Red.png",
        priceBDT: "111,000",
        stats: { cylinders: "1", capacity: "100cc", hp: "7.3" }
    },
    "honda-xblade": {
        id: "honda-xblade",
        brand: "HONDA",
        family: "SPORT",
        name: "Honda X-Blade",
        description: "Sharp design, capable performance.",
        thumbnail: "../images/MR. VIKING - About Us - MR. VIKING/All Bikes/X-Blade Pearl Spartan red.png",
        priceBDT: "240,000",
        stats: { cylinders: "1", capacity: "160cc", hp: "13.9" }
    }
};

const familyData = {
    // MR. VIKING Families
    "RUSH": ["rush-mamba"],
    "BRUTALE": ["brutale-1000-rr-assen", "brutale-1000-rr", "brutale-1000-rs", "brutale-800", "brutale-rr-80"],
    "DRAGSTER": ["dragster-rr-80"],
    "ENDURO VELOCE": ["enduro-veloce", "enduro-veloce-lxp"],
    "F3": ["f3-competizione", "f3-r", "f3-rr"],
    "SUPERVELOCE": ["superveloce-1000-ago", "superveloce-1000-oro", "superveloce-98", "superveloce-s"],
    "TURISMO VELOCE": ["turismo-veloce-r", "turismo-veloce-lusso", "turismo-veloce-r-scs"],
    
    // Honda Categories
    "HONDA_SCOOTER": ["honda-dio"],
    "HONDA_COMMUTER": ["honda-dream", "honda-livo", "honda-sp125", "honda-shine"],
    "HONDA_SPORT": ["honda-hornet", "honda-sp160", "honda-xblade"]
};
