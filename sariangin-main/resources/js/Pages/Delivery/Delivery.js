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
import { currencyFormatter } from "@/Helpers/currency";
import dayjs from "dayjs";

const Delivery = ({
  loading,
  dataSource,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const columns = [
    {
      title: "Tanggal",
      dataIndex: "date",
      key: "date",
      sorter: true,
      render: (text, record) => dayjs(record.date).format("DD/MM/YYYY"),
    },
    {
      title: "Jenis Surat",
      dataIndex: "type",
      key: "type",
      sorter: true,
    },
    {
      title: "Pelanggan",
      key: "customer",
      sorter: true,
      render: (text, record) => record.customer.name,
    },
    {
      title: "Kategori Tabung",
      key: "tankCategories",
      sorter: true,
      render: (text, record) => (
        <ol style={{ padding: 0 }}>
          {record.tank_categories?.map((item) => (
            <li key={item.id}>
              {item.name} ({item.qty})
            </li>
          ))}
        </ol>
      ),
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Lihat Detail">
            <Link href={route(routes.DELIVERIES_SHOW, record.id)}>
              <Button
                type="default"
                icon={
                  <Show size="medium" set="curved" className="remix-icon" />
                }
              />
            </Link>
          </Popover>
          <Popover content="Edit">
            <Link href={route(routes.DELIVERIES_EDIT, record.id)}>
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
        Inertia.delete(route(routes.DELIVERIES_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Surat Jalan" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Surat Jalan</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.DELIVERIES_CREATE)}>Create</Link>
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

export default withTable(Delivery, {
  routeAjaxIndex: routes.DELIVERIES_AJAX_INDEX,
});
