import {
  Activity,
  Category,
  Chart,
  Document,
  Graph,
  Home,
  Message,
  Paper,
  PaperDownload,
  PaperPlus,
  People,
} from "react-iconly";
import { routes } from "./routes";

export const navigation = [
  {
    header: "MENU",
  },
  {
    key: "dashboard",
    title: "Dashboard",
    icon: <Graph set="curved" className="remix-icon" />,
    route: routes.DASHBOARD_INDEX,
  },

  {
    key: "master-data",
    title: "Master Data",
    icon: <Category set="curved" className="remix-icon" />,
    children: [
      {
        key: "users",
        title: "Data Pengguna",
        route: routes.USERS_INDEX,
      },
      {
        key: "customers",
        title: "Data Pelanggan",
        route: routes.CUSTOMERS_INDEX,
      },
      {
        key: "vehicles",
        title: "Data Kendaraan",
        route: routes.VEHICLES_INDEX,
      },
    ],
  },

  {
    key: "inventory-tabung",
    title: "Inventory Tabung",
    icon: <Home set="curved" className="remix-icon" />,
    children: [
      {
        key: "tanks",
        title: "Data Tabung",
        route: routes.TANKS_INDEX,
      },
      {
        key: "tank-categories",
        title: "Kategori Tabung",
        route: routes.TANK_CATEGORIES_INDEX,
      },
      {
        key: "prices",
        title: "Harga Pengisian",
        route: routes.PRICES_INDEX,
      },
    ],
  },

  {
    key: "contracts",
    title: "Kontrak Peminjaman",
    icon: <Document set="curved" className="remix-icon" />,
    route: routes.CONTRACTS_INDEX,
  },

  {
    key: "deliveries",
    title: "Surat Jalan",
    icon: <Message set="curved" className="remix-icon" />,
    route: routes.DELIVERIES_INDEX,
  },

  {
    key: "invoice.index",
    title: "Faktur Pengisian",
    icon: <PaperPlus set="curved" className="remix-icon" />,
    route: "dashboard.index",
  },

  {
    key: "report",
    title: "Laporan",
    icon: <PaperDownload set="curved" className="remix-icon" />,
    children: [
      {
        key: "report-tabung.index",
        title: "Inventory Tabung",
        route: "dashboard.index",
      },
      {
        key: "contract-tabung.index",
        title: "Kontrak Tabung",
        route: "dashboard.index",
      },
      {
        key: "report-faktur.index",
        title: "Faktur Pengisian",
        route: "dashboard.index",
      },
    ],
  },
];
