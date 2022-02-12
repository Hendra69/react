import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle, Show } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";
import dayjs from "dayjs";

const Contract = ({
  loading,
  dataSource,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const columns = [
    {
      title: "Pelanggan",
      dataIndex: "customer",
      key: "customer",
      sorter: true,
      render: (text, record) => record.customer.name,
    },
    {
      title: "Dari Tanggal",
      dataIndex: "from",
      key: "from",
      sorter: true,
      render: (text, record) => dayjs(record.from).format("DD/MM/YYYY"),
    },
    {
      title: "Sampai Tanggal",
      dataIndex: "to",
      key: "to",
      sorter: true,
      render: (text, record) => dayjs(record.to).format("DD/MM/YYYY"),
    },
    // {
    //   title: "Kategori Tabung",
    //   key: "tankCategories",
    //   sorter: true,
    //   render: (text, record) => (
    //     <ol style={{ padding: 0 }}>
    //       {record.tank_categories?.map((item) => (
    //         <li key={item.id}>
    //           {item.name} ({item.qty})
    //         </li>
    //       ))}
    //     </ol>
    //   ),
    // },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Lihat Detail">
            <Link href={route(routes.CONTRACTS_SHOW, record.id)}>
              <Button
                type="default"
                icon={
                  <Show size="medium" set="curved" className="remix-icon" />
                }
              />
            </Link>
          </Popover>
          <Popover content="Edit">
            <Link href={route(routes.CONTRACTS_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title: "Hapus surat jalan?",
      icon: <InfoCircle className="remix-icon" />,
      content: "Data surat jalan ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.CONTRACTS_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Kontrak Peminjaman Tabung" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Kontrak Peminjaman Tabung</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.CONTRACTS_CREATE)}>Create</Link>
                  </Button>
                </Col>
              </Row>

              <Col span={24}>
                <Table
                  rowKey="id"
                  columns={columns}
                  dataSource={dataSource}
                  pagination={pagination}
                  loading={loading}
                  onChange={handleChangeTable}
                />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
    </React.Fragment>
  );
};

export default withTable(Contract, {
  routeAjaxIndex: routes.CONTRACTS_AJAX_INDEX,
});
