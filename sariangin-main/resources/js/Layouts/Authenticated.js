import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-react";
import { InertiaProgress } from "@inertiajs/progress";
import {
  Avatar,
  Col,
  Divider,
  Dropdown,
  Grid,
  Image,
  Layout,
  Menu,
  Row,
  Space,
  Typography,
} from "antd";
import {
  AuditOutlined,
  BookOutlined,
  DatabaseOutlined,
  FileAddOutlined,
  HomeOutlined,
  LogoutOutlined,
  MailOutlined,
  MenuUnfoldOutlined,
  MenuFoldOutlined,
  PieChartOutlined,
  UserOutlined,
} from "@ant-design/icons";
import dayjs from "dayjs";
import { getInitials } from "@/Helpers/getInitials";

const ROUTE_LIST = [
  {
    // path: "/users",
    // title: "User Management",
    // icon: <UserOutlined />,
  },
];

export const Authenticated = ({ children }) => {
  const { auth } = usePage().props;

  const { useBreakpoint } = Grid;
  const { Header, Content, Footer, Sider } = Layout;
  const { SubMenu } = Menu;
  const { Text, Title } = Typography;

  const [collapsed, setCollapsed] = useState(false);

  const handleCollapse = (value) => {
    if (value instanceof Boolean) {
      setCollapsed(value);
    } else {
      setCollapsed((previousValue) => !previousValue);
    }
  };

  const logout = () => {
    Inertia.post(route("auth.logout"));
  };

  const renderMenuItems = () => {
    // return routes.map((r) => (
    //   <Menu.Item key={r.path} icon={r.icon}>
    //     <Link href={route(r.path)}>{r.title}</Link>
    //   </Menu.Item>
    // ));
    return (
      <React.Fragment>
        <Menu.Item
          key="dashboard.index"
          icon={<PieChartOutlined />}
          className="border-rounded"
        >
          <Link href={route("dashboard.index")} style={{ color: "inherit" }}>
            Dashboard
          </Link>
        </Menu.Item>
        <SubMenu
          key="master-data"
          icon={<DatabaseOutlined />}
          title="Master Data"
        >
          <Menu.Item>Data Pengguna</Menu.Item>
          <Menu.Item>Data Pelanggan</Menu.Item>
          <Menu.Item>Data Kendaraan</Menu.Item>
        </SubMenu>
        <SubMenu
          key="inventory-tabung"
          icon={<HomeOutlined />}
          title="Inventory Tabung"
        >
          <Menu.Item>Kategori Tabung</Menu.Item>
          <Menu.Item>Harga Pengisian</Menu.Item>
        </SubMenu>
        <Menu.Item icon={<AuditOutlined />}>Kontrak Peminjaman</Menu.Item>
        <Menu.Item icon={<MailOutlined />}>Surat Jalan</Menu.Item>
        <Menu.Item icon={<FileAddOutlined />}>Faktur Pengisian</Menu.Item>
        <SubMenu key="laporan" icon={<BookOutlined />} title="Laporan">
          <Menu.Item>Inventory Tabung</Menu.Item>
          <Menu.Item>Kontrak Tabung</Menu.Item>
          <Menu.Item>Faktur Pengisian</Menu.Item>
        </SubMenu>
      </React.Fragment>
    );
  };

  const profileMenu = (
    <Menu>
      <Menu.ItemGroup
        style={{ textAlign: "center" }}
        title={<Text type="secondary">{auth.user.name}</Text>}
      />
      <Menu.Divider />
      <Menu.Item key="/" icon={<UserOutlined />}>
        <Link href="/profile">Profile</Link>
      </Menu.Item>
      <Menu.Item key="/logout" onClick={logout} icon={<LogoutOutlined />}>
        Logout
      </Menu.Item>
    </Menu>
  );

  const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

  const screens = useBreakpoint();

  return (
    <Layout style={{ minHeight: "100vh" }}>
      <Sider
        className="box-shadow"
        width={256}
        breakpoint="md"
        theme="light"
        collapsible
        collapsed={collapsed}
        onCollapse={(collapsed, type) => {
          handleCollapse(collapsed);
        }}
      >
        {/* Logo */}
        <div
          style={{
            background: "#fafafa",
            height: 64,
            width: "100%",
            textAlign: "center",
            margin: "16px 0 8px",
          }}
        >
          <Link href={route("dashboard.index")}>
            <Image
              height="100%"
              preview={false}
              src="/storage/assets/logo.png"
            />
          </Link>
        </div>

        {/* <Divider style={{ margin: 1 }} /> */}

        <Menu
          mode="inline"
          defaultSelectedKeys={["dashboard"]}
          selectedKeys={route().current()}
          style={{ padding: "0 12px" }}
        >
          {renderMenuItems()}
        </Menu>
      </Sider>

      <Layout>
        <Header
          className="border-rounded box-shadow"
          style={{
            background: "#fff",
            padding: "0px 24px",
            margin: "16px 32px 32px",
          }}
        >
          <Row
            align="middle"
            justify="space-between"
            style={{ width: "100%", height: "100%" }}
          >
            <Space align="center" size="large" style={{ paddingTop: 2 }}>
              {React.createElement(
                collapsed ? MenuUnfoldOutlined : MenuFoldOutlined,
                {
                  style: {
                    fontSize: 18,
                  },
                  onClick: handleCollapse,
                }
              )}
              {screens["sm"] && (
                <Title level={4} style={{ display: "inline-block", margin: 0 }}>
                  {appName}
                </Title>
              )}
            </Space>

            <Dropdown overlay={profileMenu} trigger={["click"]}>
              <Space align="center" style={{ cursor: "pointer" }}>
                <Avatar
                  size={40}
                  // src={user?.avatar_path ? getStorageUrl(user.avatar_path) : null}
                  style={{
                    // backgroundColor: "#da251c",
                    display: "inline-block",
                    marginBottom: 4,
                  }}
                >
                  {getInitials(auth.user.name)}
                </Avatar>
              </Space>
            </Dropdown>
          </Row>
        </Header>

        <Content style={{ margin: "0 32px" }}>
          {React.cloneElement(children, { auth })}
        </Content>

        <Footer style={{ textAlign: "center" }}>
          {dayjs().year()} &copy; Tokoweb.co
        </Footer>
      </Layout>
    </Layout>
  );
};
